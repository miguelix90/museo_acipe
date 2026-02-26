# 🎨 MuseAI - Museo Digital ACIPE

Museo digital interactivo que explora la intersección entre la literatura, el arte y la inteligencia artificial, desarrollado para la Asociación Colegial de Ingenieros de Caminos, Canales y Puertos (ACIPE).

## 📋 Características

- **Exposiciones Temáticas**: Colecciones curadas de libros de ciencia con arte generado por IA
- **Salas Interactivas**: Espacios virtuales con contenido multimedia
- **Biblioteca Digital**: Catálogo de libros con reseñas y enlaces externos
- **Arte Generativo**: Imágenes creadas con algoritmos VQGAN+CLIP
- **Nubes de Palabras**: Visualizaciones semánticas de contenido literario
- **Panel de Administración**: Gestión completa de exposiciones, salas y libros

## 🛠️ Tecnologías

- **Framework**: Laravel 11
- **Frontend**: Tailwind CSS
- **Base de Datos**: MySQL
- **Gestión de Medios**: Spatie Media Library
- **Autenticación**: Laravel Breeze

## 📦 Instalación

### Requisitos Previos

- PHP 8.2+
- Composer
- MySQL 5.7+
- Node.js & NPM

### Paso 1: Clonar el repositorio

```bash
git clone https://github.com/TU_USUARIO/museo-laravel.git
cd museo-laravel
```

### Paso 2: Instalar dependencias

```bash
composer install
npm install
```

### Paso 3: Configurar entorno

```bash
cp .env.example .env
php artisan key:generate
```

Edita `.env` con tus credenciales de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=museo_laravel
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### Paso 4: Migrar base de datos

```bash
php artisan migrate
```

### Paso 5: Crear enlace simbólico para storage

```bash
php artisan storage:link
```

### Paso 6: Compilar assets (opcional)

```bash
npm run build
```

### Paso 7: Iniciar servidor de desarrollo

```bash
php artisan serve
```

Visita: `http://localhost:8000`

## 🚀 Deployment en Producción

### Configuración de Plesk/Servidor

1. **Clonar repositorio** vía Git en Plesk
2. **Instalar dependencias**:
   ```bash
   composer install --optimize-autoloader --no-dev
   ```
3. **Configurar `.env`** con credenciales de producción
4. **Generar key**:
   ```bash
   php artisan key:generate
   ```
5. **Migrar base de datos**:
   ```bash
   php artisan migrate --force
   ```
6. **Crear enlace simbólico**:
   ```bash
   php artisan storage:link
   ```
7. **Optimizar**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
8. **Configurar permisos**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

### ⚠️ IMPORTANTE: Imágenes

Las imágenes **NO están en el repositorio Git**. Debes:

1. Exportar la carpeta `storage/app/public/` de tu entorno local
2. Subirla via FTP/SFTP al servidor en la misma ruta
3. Asegurarte de que el enlace simbólico existe: `php artisan storage:link`

## 📊 Base de Datos

### Exportar (Local)

```bash
mysqldump -u root -p museo_laravel > backup_museo_laravel.sql
```

### Importar (Servidor)

```bash
mysql -u usuario -p museo_laravel < backup_museo_laravel.sql
```

O vía phpMyAdmin.

## 👥 Estructura del Proyecto

```
museo-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controladores del panel admin
│   │   └── MuseoController.php
│   └── Models/
│       ├── Exposicion.php
│       ├── Sala.php
│       └── Libro.php
├── resources/
│   └── views/
│       ├── admin/          # Vistas del panel admin
│       └── museo/          # Vistas públicas
├── routes/
│   └── web.php
├── storage/
│   └── app/
│       └── public/         # ⚠️ NO EN GIT - Imágenes
└── public/
    └── assets/
        └── img/            # Logos, iconos estáticos
```

## 🔐 Acceso Administrativo

URL: `/login`

Crear usuario admin:

```bash
php artisan tinker
```

```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@acipe.es';
$user->password = bcrypt('password');
$user->save();
```

## 📝 Licencia

Proyecto desarrollado para ACIPE - Todos los derechos reservados.

## 👨‍💻 Equipo

- **Diseño de Exposición**: Juan Fernández
- **Inteligencia Artificial**: Javier Aroztegui
- **Desarrollo Web**: Miguel Ángel Huete

## 🔗 Enlaces

- [ACIPE](https://acipe.es)
- [Documentación Laravel](https://laravel.com/docs)
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary)
