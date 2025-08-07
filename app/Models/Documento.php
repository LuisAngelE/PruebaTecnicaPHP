<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    // Un documento pertenece a una carpeta
    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class);
    }

    // Un documento pertenece a un tipo de archivo
    public function tipoArchivo()
    {
        return $this->belongsTo(TipoArchivo::class);
    }
}
