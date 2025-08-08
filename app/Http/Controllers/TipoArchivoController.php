<?php

namespace App\Http\Controllers;

use App\Models\TipoArchivo;
use Illuminate\Http\Request;

class TipoArchivoController extends Controller
{
    /**
     * Listar todos los tipos de archivo con sus documentos.
     */
    public function index()
    {
        $tipos = TipoArchivo::with('documentos')->get();
        return response()->json($tipos);
    }

    /**
     * Crear un tipo de archivo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $tipoArchivo = TipoArchivo::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Tipo de archivo creado exitosamente',
            'tipo_archivo' => $tipoArchivo,
        ], 201);
    }

    /**
     * Mostrar un tipo de archivo específico.
     */
    public function show($id)
    {
        $tipoArchivo = TipoArchivo::with('documentos')->find($id);

        if (!$tipoArchivo) {
            return response()->json(['message' => 'Tipo de archivo no encontrado'], 404);
        }

        return response()->json($tipoArchivo);
    }

    /**
     * Actualizar un tipo de archivo.
     */
    public function update(Request $request, $id)
    {
        $tipoArchivo = TipoArchivo::find($id);

        if (!$tipoArchivo) {
            return response()->json(['message' => 'Tipo de archivo no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $tipoArchivo->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Tipo de archivo actualizado correctamente',
            'tipo_archivo' => $tipoArchivo,
        ]);
    }

    /**
     * Eliminar un tipo de archivo.
     */
    public function destroy($id)
    {
        $tipoArchivo = TipoArchivo::find($id);

        if (!$tipoArchivo) {
            return response()->json(['message' => 'Tipo de archivo no encontrado'], 404);
        }

        $tipoArchivo->delete();

        return response()->json(['message' => 'Tipo de archivo eliminado correctamente']);
    }
}
