<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Empresa;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    /**
     * Mostrar todas las direcciones con sus empresas.
     */
    public function index()
    {
        $direcciones = Direccion::with(['empresa', 'areas'])->get();
        return response()->json($direcciones);
    }

    /**
     * Almacenar una nueva dirección.
     */
    public function store(Request $request)
    {
        $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'nombre' => 'required|string|max:255',
        ]);

        $direccion = Direccion::create([
            'empresa_id' => $request->empresa_id,
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Dirección creada exitosamente',
            'direccion' => $direccion,
        ], 201);
    }

    /**
     * Mostrar una dirección específica.
     */
    public function show($id)
    {
        $direccion = Direccion::with(['empresa', 'areas'])->find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        return response()->json($direccion);
    }

    /**
     * Actualizar una dirección específica.
     */
    public function update(Request $request, $id)
    {
        $direccion = Direccion::find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        $request->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'nombre' => 'required|string|max:255',
        ]);

        $direccion->update([
            'empresa_id' => $request->empresa_id,
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Dirección actualizada correctamente',
            'direccion' => $direccion,
        ]);
    }

    /**
     * Eliminar una dirección específica.
     */
    public function destroy($id)
    {
        $direccion = Direccion::find($id);

        if (!$direccion) {
            return response()->json(['message' => 'Dirección no encontrada'], 404);
        }

        $direccion->delete();

        return response()->json(['message' => 'Dirección eliminada correctamente']);
    }
}
