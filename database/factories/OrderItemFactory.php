<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Libro;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(), // Relación con una orden
            'libro_id' => Libro::factory(), // Relación con un libro
            'cantidad' => $this->faker->numberBetween(1, 5),
            'precio_unitario' => $this->faker->randomFloat(2, 100, 500), // Precio entre 100 y 500
        ];
    }
}