<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    /**
     * Listar todas las carpetas con área, carpeta padre, subcarpetas y documentos.
     */
    public function index()
    {
        $carpetas = Carpeta::with(['area', 'padre', 'subcarpetas', 'documentos'])->get();
        return response()->json($carpetas);
    }

    /**
     * Crear una carpeta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'padre_id' => 'nullable|exists:carpetas,id',
            'nombre' => 'required|string|max:255',
        ]);

        $carpeta = Carpeta::create([
            'area_id' => $request->area_id,
            'padre_id' => $request->padre_id,
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Carpeta creada exitosamente',
            'carpeta' => $carpeta,
        ], 201);
    }

    /**
     * Mostrar una carpeta específica.
     */
    public function show($id)
    {
        $carpeta = Carpeta::with(['area', 'padre', 'subcarpetas', 'documentos'])->find($id);

        if (!$carpeta) {
            return response()->json(['message' => 'Carpeta no encontrada'], 404);
        }

        return response()->json($carpeta);
    }

    /**
     * Actualizar una carpeta.
     */
    public function update(Request $request, $id)
    {
        $carpeta = Carpeta::find($id);

        if (!$carpeta) {
            return response()->json(['message' => 'Carpeta no encontrada'], 404);
        }

        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'padre_id' => 'nullable|exists:carpetas,id',
            'nombre' => 'required|string|max:255',
        ]);

        $carpeta->update([
            'area_id' => $request->area_id,
            'padre_id' => $request->padre_id,
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Carpeta actualizada correctamente',
            'carpeta' => $carpeta,
        ]);
    }

    /**
     * Eliminar una carpeta.
     */
    public function destroy($id)
    {
        $carpeta = Carpeta::find($id);

        if (!$carpeta) {
            return response()->json(['message' => 'Carpeta no encontrada'], 404);
        }

        $carpeta->delete();

        return response()->json(['message' => 'Carpeta eliminada correctamente']);
    }
}
