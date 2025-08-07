<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArchivo extends Model
{
    use HasFactory;

    // Un tipo de archivo puede tener muchos documentos
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
