<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Mostrar todas las áreas con sus direcciones y carpetas.
     */
    public function index()
    {
        $areas = Area::with(['direccion', 'carpetas'])->get();
        return response()->json($areas);
    }

    /**
     * Almacenar una nueva área.
     */
    public function store(Request $request)
    {
        $request->validate([
            'direccion_id' => 'required|exists:direcciones,id',
            'nombre' => 'required|string|max:255',
        ]);

        $area = Area::create([
            'direccion_id' => $request->direccion_id,
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Área creada exitosamente',
            'area' => $area,
        ], 201);
    }

    /**
     * Mostrar una área específica.
     */
    public function show($id)
    {
        $area = Area::with(['direccion', 'carpetas'])->find($id);

        if (!$area) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }

        return response()->json($area);
    }

    /**
     * Actualizar un área específica.
     */
    public function update(Request $request, $id)
    {
        $area = Area::find($id);

        if (!$area) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }

        $request->validate([
            'direccion_id' => 'required|exists:direcciones,id',
            'nombre' => 'required|string|max:255',
        ]);

        $area->update([
            'direccion_id' => $request->direccion_id,
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Área actualizada correctamente',
            'area' => $area,
        ]);
    }

    /**
     * Eliminar un área específica.
     */
    public function destroy($id)
    {
        $area = Area::find($id);

        if (!$area) {
            return response()->json(['message' => 'Área no encontrada'], 404);
        }

        $area->delete();

        return response()->json(['message' => 'Área eliminada correctamente']);
    }
}
