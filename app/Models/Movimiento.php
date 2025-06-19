<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable =[
        "user_id",
        "categoria_id",
        "tipo",
        "monto",
        "descripcion",
        "foto",
        "fecha"
    ];

    // relacion de muchos a uno con el modelo usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // relacion de muchos a uno con el modelo categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    // shif + alt + a  comentario 
    // evento para actualizar el monto gastado cuando se crea un movimiento
    /* protected static function updateMovement()
    {
        
        static::created(function ($movimiento) {
            $categoria = $movimiento->categoria;
            if ($movimiento->tipo === 'Gasto') {
                $categoria->monto_gastado += $movimiento->monto;
            } else {
                $categoria->monto_gastado -= $movimiento->monto;
            }
            $categoria->save();
        });
    } */
}
