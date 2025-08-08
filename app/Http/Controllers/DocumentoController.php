<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Listar todos los documentos con carpeta y tipo de archivo.
     */
    public function index()
    {
        $documentos = Documento::with(['carpeta', 'tipoArchivo'])->get();
        return response()->json($documentos);
    }

    /**
     * Crear un documento.
     */
    public function store(Request $request)
    {
        $request->validate([
            'carpeta_id' => 'required|exists:carpetas,id',
            'tipo_archivo_id' => 'required|exists:tipos_archivos,id',
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|string|max:255',
            'fecha_creacion' => 'required|date',
        ]);

        $documento = Documento::create([
            'carpeta_id' => $request->carpeta_id,
            'tipo_archivo_id' => $request->tipo_archivo_id,
            'nombre' => $request->nombre,
            'archivo' => $request->archivo,
            'fecha_creacion' => $request->fecha_creacion,
        ]);

        return response()->json([
            'message' => 'Documento creado exitosamente',
            'documento' => $documento,
        ], 201);
    }

    /**
     * Mostrar un documento específico.
     */
    public function show($id)
    {
        $documento = Documento::with(['carpeta', 'tipoArchivo'])->find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento no encontrado'], 404);
        }

        return response()->json($documento);
    }

    /**
     * Actualizar un documento.
     */
    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento no encontrado'], 404);
        }

        $request->validate([
            'carpeta_id' => 'required|exists:carpetas,id',
            'tipo_archivo_id' => 'required|exists:tipos_archivos,id',
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|string|max:255',
            'fecha_creacion' => 'required|date',
        ]);

        $documento->update([
            'carpeta_id' => $request->carpeta_id,
            'tipo_archivo_id' => $request->tipo_archivo_id,
            'nombre' => $request->nombre,
            'archivo' => $request->archivo,
            'fecha_creacion' => $request->fecha_creacion,
        ]);

        return response()->json([
            'message' => 'Documento actualizado correctamente',
            'documento' => $documento,
        ]);
    }

    /**
     * Eliminar un documento.
     */
    public function destroy($id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Documento no encontrado'], 404);
        }

        $documento->delete();

        return response()->json(['message' => 'Documento eliminado correctamente']);
    }
}
