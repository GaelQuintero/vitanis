<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //

    protected $guarded = [];

    public function producto()
    {
        return $this->belongsTo(Inventario::class);
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'id'); // Ajusta la clave foránea si es diferente
    }

}
