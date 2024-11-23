<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'libro_id', 'cantidad', 'precio_unitario'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
