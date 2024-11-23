<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'libro_id', 'titulo', 'review','fecha'];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id'); // 'id_book' es la columna en la tabla reviews
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'id_user' es la columna en la tabla reviews
    }
}
