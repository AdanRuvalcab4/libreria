<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Libro;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_order()
    {
        // Crear un usuario autenticado
        $user = User::factory()->create();

        // Crear libros de prueba
        $libros = Libro::factory()->count(3)->create();

        // Datos para la orden
        $orderData = [
            'libro_id' => $libros->pluck('id')->toArray(),
            'cantidad' => [1, 2, 1], // Cantidad por libro
        ];

        // Simular inicio de sesión
        $this->actingAs($user);

        // Realizar la petición POST para crear la orden
        $response = $this->post('/orders', $orderData);

        // Asegurarse de que la orden se creó correctamente y redirige
        $response->assertRedirect('/orders');
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
        ]);

        // Verificar que los items de la orden se guardaron correctamente
        foreach ($libros as $index => $libro) {
            $this->assertDatabaseHas('order_items', [
                'libro_id' => $libro->id,
                'cantidad' => $orderData['cantidad'][$index],
            ]);
        }
    }

    public function test_user_can_view_order()
    {
    
        $user = User::factory()->create();
        $order = Order::factory()->for($user)->create();
        $libros = Libro::factory()->count(3)->create();

        foreach ($libros as $libro) {
            OrderItem::factory()->create([
                'order_id' => $order->id,
                'libro_id' => $libro->id,
                'cantidad' => 1,
            ]);
        }

        // Simular inicio de sesión
        $this->actingAs($user);

        // Verificar que el usuario puede ver la orden
        $response = $this->get("/orders/{$order->id}");

        $response->assertStatus(200);
        $response->assertSee($order->id);

        // Verificar que los libros relacionados aparecen en la vista
        foreach ($libros as $libro) {
            $response->assertSee($libro->nombre);
        }
    }
}