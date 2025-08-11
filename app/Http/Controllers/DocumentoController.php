<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Listar todos los documentos con carpeta y tipo de archivo.
     */
    public function index(Request $request)
    {
        $query = Documento::with(['carpeta', 'tipoArchivo']);

        if ($request->has('nombre') && !empty($request->nombre)) {
            $search = $request->nombre;
            $query->where('nombre', 'LIKE', "%{$search}%");
        }

        if ($request->has('tipo_archivo_id') && !empty($request->tipo_archivo_id)) {
            $query->where('tipo_archivo_id', $request->tipo_archivo_id);
        }

        if ($request->has('carpeta_id') && !empty($request->carpeta_id)) {
            $query->where('carpeta_id', $request->carpeta_id);
        }

        $documentos = $query->get();

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
            'archivo' => 'required|file',
            'fecha_creacion' => 'required|date',
        ]);

        $rutaArchivo = $request->file('archivo')->store('public/documentos');
        $rutaArchivo = str_replace('public/', '', $rutaArchivo);

        $documento = Documento::create([
            'carpeta_id' => $request->carpeta_id,
            'tipo_archivo_id' => $request->tipo_archivo_id,
            'nombre' => $request->nombre,
            'archivo' => $rutaArchivo,
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
    public function updateConArchivo(Request $request, $id)
    {
        $documento = Documento::find($id);
        if (!$documento) {
            return response()->json(['message' => 'Documento no encontrado'], 404);
        }

        $request->validate([
            'carpeta_id' => 'required|exists:carpetas,id',
            'tipo_archivo_id' => 'required|exists:tipos_archivos,id',
            'nombre' => 'required|string|max:255',
            'archivo' => 'nullable|file',
            'fecha_creacion' => 'required|date',
        ]);

        if ($request->hasFile('archivo')) {
            if ($documento->archivo && \Storage::exists('public/' . $documento->archivo)) {
                \Storage::delete('public/' . $documento->archivo);
            }

            $rutaArchivo = $request->file('archivo')->store('public/documentos');
            $rutaArchivo = str_replace('public/', '', $rutaArchivo);
            $documento->archivo = $rutaArchivo;
        }

        $documento->carpeta_id = $request->carpeta_id;
        $documento->tipo_archivo_id = $request->tipo_archivo_id;
        $documento->nombre = $request->nombre;
        $documento->fecha_creacion = $request->fecha_creacion;
        $documento->save();

        return response()->json([
            'message' => 'Documento actualizado exitosamente',
            'documento' => $documento,
        ], 200);
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

        if ($documento->archivo && Storage::exists('public/' . $documento->archivo)) {
            Storage::delete('public/' . $documento->archivo);
        }

        $documento->delete();

        return response()->json(['message' => 'Documento eliminado correctamente']);
    }
}
