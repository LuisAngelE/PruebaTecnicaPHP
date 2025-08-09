# README Backend (Laravel)

## Prueba Práctica Backend - Laravel PHP 8.1

### Requisitos
- PHP 8.1 o superior  
- Composer  
- MySQL u otra base de datos compatible configurada  
- Extensiones PHP necesarias para Laravel  

---

### Instalación
```bash
# Clonar el repositorio
git clone <URL_DEL_REPOSITORIO_BACKEND>
cd <CARPETA_BACKEND>

# Instalar dependencias
composer install

# Editar .env con credenciales de base de datos y otros valores necesarios
.env

# Crear una base de datos vacía en MySQL
# Importar la base de datos desde un respaldo
respaldo.sql

# Generar la clave de la aplicación
php artisan key:generate

# Iniciar servidor local
php artisan serve
