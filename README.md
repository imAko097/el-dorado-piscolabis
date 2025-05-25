# El Dorado Piscolabis

## Descripción
El Dorado Piscolabis es una aplicación web moderna desarrollada con Laravel 12 y Livewire 3, diseñada para gestionar y optimizar el servicio de piscolabis.

## Tecnologías Principales
- **Backend**: 
  - PHP 8.2
  - Laravel 12
  - Livewire 3
  - Livewire Volt
- **Frontend**:
  - TailwindCSS
  - Alpine.js
  - Vite
  - Animate.css
  - jQuery
  - Toastify.js

## Requisitos del Sistema
- PHP >= 8.2
- Composer
- Node.js >= 18
- NPM
- MySQL

## Estructura del Proyecto
```
├── app/                    # Lógica principal de la aplicación
│   ├── Http/              # Controladores y Middleware
│   ├── Models/            # Modelos de Eloquent
│   ├── Livewire/          # Componentes Livewire
│   └── Services/          # Servicios de la aplicación
├── config/                # Archivos de configuración
├── database/              # Migraciones y seeders
├── public/                # Punto de entrada y assets públicos
├── resources/             # Assets y vistas
│   ├── css/              # Estilos CSS
│   ├── js/               # JavaScript
│   └── views/            # Vistas Blade
├── routes/                # Definición de rutas
├── storage/               # Archivos subidos y logs
└── tests/                 # Tests automatizados
```

## Instalación

1. Clonar el repositorio:
```bash
git clone [URL_DEL_REPOSITORIO]
cd el-dorado-piscolabis
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node:
```bash
npm install
```

4. Configurar el entorno:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=el_dorado_piscolabis
DB_USERNAME=root
DB_PASSWORD=
```

6. Ejecutar las migraciones:
```bash
php artisan migrate
```

7. Compilar los assets:
```bash
npm run build
```

## Desarrollo

Para iniciar el servidor de desarrollo:
```bash
php artisan serve
npm run dev
```

O usar el comando de desarrollo que ejecuta todo en paralelo:
```bash
composer dev
```

## Testing

Ejecutar los tests:
```bash
composer test
```

## Características Principales
- Sistema de autenticación
- Gestión de usuarios
- Panel de administración
- Interfaz responsive
- Notificaciones en tiempo real
- Optimización de rendimiento

## Contribución
1. Fork el proyecto
2. Crea tu rama de características (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## Licencia
Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.
