<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    // Una dirección pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    // Una dirección puede tener muchas áreas
    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
