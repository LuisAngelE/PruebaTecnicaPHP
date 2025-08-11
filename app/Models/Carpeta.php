<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    use HasFactory;

    protected $table = 'carpetas';

    protected $fillable = [
        'area_id',
        'padre_id',
        'nombre',
    ];

    // Una carpeta pertenece a un área
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // Una carpeta puede tener muchas subcarpetas (hijas)
    public function subcarpetas()
    {
        return $this->hasMany(Carpeta::class, 'padre_id');
    }

    // Una carpeta puede pertenecer a una carpeta padre
    public function padre()
    {
        return $this->belongsTo(Carpeta::class, 'padre_id');
    }

    // Una carpeta puede tener muchos documentos
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
