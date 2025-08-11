<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    /**
     * Listar todas las carpetas con área, carpeta padre, subcarpetas y documentos.
     */
    public function index(Request $request)
    {
        $query = Carpeta::with(['area', 'padre', 'subcarpetas', 'documentos']);
        if ($request->has('padre_id')) {
            $query->where('padre_id', $request->padre_id);
        }
        if ($request->has('area_id')) {
            $query->where('area_id', $request->area_id);
        }
        return response()->json($query->get());
    }


    /**
     * Crear una carpeta.
     */
    public function store(Request $request, $id = null)
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

        if ($request->padre_id && $request->padre_id == $id) {
            return response()->json(['message' => 'Una carpeta no puede ser su propio padre'], 400);
        }

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

        if ($request->padre_id && $request->padre_id == $id) {
            return response()->json(['message' => 'Una carpeta no puede ser su propio padre'], 400);
        }

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

        if ($carpeta->documentos()->exists() || $carpeta->subcarpetas()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar la carpeta porque contiene documentos o subcarpetas'
            ], 400);
        }


        $carpeta->delete();

        return response()->json(['message' => 'Carpeta eliminada correctamente']);
    }
}
