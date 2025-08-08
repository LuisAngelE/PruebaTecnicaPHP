<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Mostrar todas las empresas.
     */
    public function index()
    {
        $empresas = Empresa::with('direcciones')->get();
        return response()->json($empresas);
    }

    /**
     * Almacenar una nueva empresa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $empresa = Empresa::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Empresa creada exitosamente',
            'empresa' => $empresa,
        ], 201);
    }

    /**
     * Mostrar una empresa específica.
     */
    public function show($id)
    {
        $empresa = Empresa::with('direcciones')->find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        return response()->json($empresa);
    }

    /**
     * Actualizar una empresa específica.
     */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $empresa->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Empresa actualizada correctamente',
            'empresa' => $empresa,
        ]);
    }

    /**
     * Eliminar una empresa específica.
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        $empresa->delete();

        return response()->json(['message' => 'Empresa eliminada correctamente']);
    }
}
