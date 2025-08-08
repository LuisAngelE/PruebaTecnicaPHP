<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestión de Documentos</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

  <!-- Header -->
  <header class="bg-yellow-600 text-white p-4 shadow">
    <h1 class="text-2xl font-bold">📁 Sistema de Gestión de Documentos</h1>
  </header>

  <div class="flex flex-col md:flex-row min-h-screen">



    <!-- Main content -->
    <main class="flex-1 p-6 space-y-6">

      <!-- Formulario de creación -->
      <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">📄 Crear Documento</h2>
        <form method="POST" enctype="multipart/form-data">
          <!-- Simulación de selects dinámicos -->
          <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
              <label class="block mb-1">Empresa</label>
              <select class="w-full border rounded px-2 py-1">
                <option value="">Selecciona...</option>
              </select>
            </div>
            <div>
              <label class="block mb-1">Dirección</label>
              <select class="w-full border rounded px-2 py-1">
                <option value="">Selecciona...</option>
              </select>
            </div>
            <div>
              <label class="block mb-1">Área</label>
              <select class="w-full border rounded px-2 py-1">
                <option value="">Selecciona...</option>
              </select>
            </div>
            <div>
              <label class="block mb-1">Tipo de Archivo</label>
              <select class="w-full border rounded px-2 py-1">
                <option value="">Selecciona...</option>
              </select>
            </div>
          </div>
          <div class="mb-4">
            <label class="block mb-1">Nombre del Documento</label>
            <input type="text" class="w-full border rounded px-2 py-1" />
          </div>
          <div class="mb-4">
            <label class="block mb-1">Archivo</label>
            <input type="file" class="w-full" />
          </div>
          <button class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Subir Documento</button>
        </form>
      </section>

      <!-- Documentos listados -->
      <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">📑 Documentos</h2>
        <table class="w-full table-auto border">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 text-left">Nombre</th>
              <th class="px-4 py-2 text-left">Tipo</th>
              <th class="px-4 py-2 text-left">Fecha</th>
              <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Documento de ejemplo -->
            <tr class="border-t">
              <td class="px-4 py-2">Manual de Usuario</td>
              <td class="px-4 py-2">Procedimiento</td>
              <td class="px-4 py-2">2025-08-07</td>
              <td class="px-4 py-2 space-x-2">
                <button class="text-blue-600 hover:underline">Editar</button>
                <button class="text-red-600 hover:underline">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

    </main>
  </div>

</body>
</html>
