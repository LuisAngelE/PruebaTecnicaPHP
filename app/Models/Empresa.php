<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    // Una empresa puede tener muchas direcciones
    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }
}
