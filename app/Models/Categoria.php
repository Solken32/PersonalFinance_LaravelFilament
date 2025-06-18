<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable=[
        "nombre",
        "tipo"
    ];

    // relacion de uno a muchos con el modelo presupuesto
    //public function presupuestos(){
    //    return $this->hasMany(Presupuesto::class);
    //}

    // relacion de uno a muchos con el modelo movimientos
    public function movimientos(){
        return $this->hasMany(Movimiento::class);
    }
}
