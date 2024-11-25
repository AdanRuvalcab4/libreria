<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Libro;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('orders.index-orders', compact('orders'));
    }

    public function create()
    {
        $libros = Libro::all();
        return view('orders.create-order', compact('libros'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Debe estar autenticado para realizar una orden.');
        }

        $request->validate([
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
        ]);

        foreach ($request->libro_id as $index => $libroId) {
            $libro = Libro::find($libroId);

            OrderItem::create([
                'order_id' => $order->id,
                'libro_id' => $libro->id,
                'cantidad' => $request->cantidad[$index],
                'precio_unitario' => $libro->precio,
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Orden creada con éxito');
    }

    public function show(Order $order)
    {
        return view('orders.show-order', compact('order'));
    }

    public function edit(Order $order)
    {
        $libros = Libro::all();
        return view('orders.edit-order', compact('order', 'libros'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libro_id' => 'required|array',
            'libro_id.*' => 'exists:libros,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1',
            'order_item_id' => 'array',
            'order_item_id.*' => 'nullable|integer|exists:order_items,id',
            'remove_item' => 'array',
            'remove_item.*' => 'integer|exists:order_items,id',
        ]);

        $order = Order::findOrFail($id);

        if ($request->has('remove_item')) {
            OrderItem::whereIn('id', $request->remove_item)->delete();
        }

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

        return redirect()->route('orders.show', $order->id);
    }

    public function destroy(Order $order)
    {
        $order->orderItems()->delete();
        $order->delete();
        return redirect()->route('orders.index');
    }
}
