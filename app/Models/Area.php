<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // Un área pertenece a una dirección
    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    // Un área puede tener muchas carpetas
    public function carpetas()
    {
        return $this->hasMany(Carpeta::class);
    }
}
