<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Libro;
use App\Models\OrderItem;
use Illuminate\Http\Request;


class OrderController extends Controller 
{
    /*public static function middleware(): array
    {
        return [
            // 'auth',
            new Middleware('auth', except: ['index', 'show']),
            // new Middleware('subscribed', only: ['store']),
        ];
    }*/

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $orders = Order::with('user') // Cargar relación con usuarios
            ->orderBy('created_at', 'desc') // Ordenar por fecha
            ->paginate(10); // Paginación para evitar cargar demasiados datos

        return view('orders.index-orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libros = Libro::all(); // Obtén todos los libros disponibles desde la base de datos
        return view('orders.create-order', compact('libros')); // Pasa $libros a la vista
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debe estar autenticado para realizar una orden.');
        }
    
        $request->validate([
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id', // Valida que cada libro exista
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1', // Valida que cada cantidad sea un número entero mayor a 0
        ]);

        // Creamos la orden en orders
        $order = Order::create([
            'user_id' => auth()->id(),
        ]);

        // Itera sobre los libros seleccionados y crea los items de la orden
        foreach ($request->libro_id as $index => $libroId) {
            $libro = Libro::find($libroId);

            OrderItem::create([
                'order_id' => $order->id,
                'libro_id' => $libro->id,
                'cantidad' => $request->cantidad[$index],
                'precio_unitario' => $libro->precio,
            ]);
        }

        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show-order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

        // Obtén todos los libros disponibles
        $libros = Libro::all();

        // Pasa la variable $libros a la vista
        return view('orders.edit-order', compact('order', 'libros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validaciones
        $request->validate([
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1',
            'order_item_id' => 'array', // IDs de items existentes
            'order_item_id.*' => 'nullable|integer|exists:order_items,id',
            'remove_item' => 'array', // IDs de items a eliminar
            'remove_item.*' => 'integer|exists:order_items,id',
        ]);

        $order = Order::findOrFail($id);

        // Eliminar productos marcados
        if ($request->has('remove_item')) {
            OrderItem::whereIn('id', $request->remove_item)->delete();
        }

        // Actualizar productos existentes
        if ($request->has('order_item_id')) {
            foreach ($request->order_item_id as $index => $itemId) {
                $item = OrderItem::find($itemId);
                if ($item) {
                    $item->update([
                        'libro_id' => $request->libro_id[$index],
                        'cantidad' => $request->cantidad[$index],
                    ]);
                }
            }
        }

        // Agregar nuevos productos
        if (count($request->libro_id) > count($request->order_item_id ?? [])) {
            foreach ($request->libro_id as $index => $libroId) {
                if (!isset($request->order_item_id[$index])) {
                    $libro = Libro::find($libroId);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'libro_id' => $libro->id,
                        'cantidad' => $request->cantidad[$index],
                        'precio_unitario' => $libro->precio,
                    ]);
                }
            }
        }

        // Redirigir a la vista de detalles de la orden
        return redirect()->route('order.show', $order->id);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->orderItems()->delete(); // Elimina los productos asociados a la orden
        $order->delete();
        return redirect()->route('order.index');
    }

}
