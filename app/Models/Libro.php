<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'autor', 'precio', 'stock', 'descripcion'];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'libro_id'); // 'id_book' es la columna en reviews
    }
}