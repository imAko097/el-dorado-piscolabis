# 🟡 El Dorado

**El Dorado** es una plataforma digital desarrollada con Laravel, Livewire y Tailwind CSS para la gestión de pedidos en un local de piscolabis. Incluye una interfaz de cliente para realizar pedidos y un panel administrativo para la gestión de productos, usuarios, pedidos e imágenes promocionales.

---

## 📦 Requisitos del sistema

Asegúrate de tener instaladas las siguientes herramientas:

Backend:
- PHP 8.2
- Laravel 12
- Livewire 3
- Livewire Volt

Frontend:
- TailwindCSS
- Alpine.js
- Vite
- Animate.css
- jQuery
- Toastify.js

Extensiones PHP requeridas:  
      `pdo`, `mbstring`, `openssl`, `fileinfo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `curl`

---

## 🚀 Instalación

### 1. Clona el repositorio

```bash
git clone https://github.com/imAko097/el-dorado-piscolabis.git
cd el-dorado-piscolabis
```

### 2. Instala las dependencias de PHP

```bash
composer install
```

### 3. Instala las dependencias de JavaScript

```bash
npm install
```

### 4. Configura el entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` con la configuración de tu base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=el_dorado
DB_USERNAME=root
DB_PASSWORD=secret
```

### 5. Genera la clave de aplicación

```bash
php artisan key:generate
```

### 6. Ejecuta las migraciones y seeders

```bash
php artisan migrate --seed
```

Esto creará las tablas necesarias y usuarios de prueba con roles predefinidos.

### 7. Compila los assets

```bash
npm run dev
```

Para entorno de producción:

```bash
npm run build
```

### 8. Inicia el servidor de desarrollo

```bash
php artisan serve
```

Accede a la aplicación en tu navegador:

```
http://localhost:8000
```

---

## 👤 Acceso al panel de administración

El sistema incluye usuarios de ejemplo tras ejecutar los seeders:

| Rol           | Email                       | Contraseña |
|---------------|-----------------------------|------------|
| Administrador | admin@admin.com             | Pilotes20! |
| Empleado      | empleado@dorado.com         | Pilotes20! |
| Cliente       | clientedorado1@gmail.com    | Pilotes20! |

Puedes registrar nuevos usuarios desde la interfaz y activar sus roles desde el panel de administración (si tienes rol de administrador).

---

## ⚙️ Funcionalidades principales

### Para clientes

- Consultar menú  
- Realizar pedidos  
- Ver historial de compras  
- Recibir factura digital  
- Ver promociones en el carrusel  

### Para administradores

- CRUD de productos  
- Gestión de pedidos por estado  
- Gestión de usuarios y roles  
- Subida y ordenamiento de imágenes del carrusel  
- Destacar productos en la página principal  

---

## 🔒 Autenticación y roles

El sistema usa autenticación con verificación por correo. Tras registrarse, los usuarios deben confirmar su cuenta para acceder. El sistema redirige automáticamente a cada usuario según su rol:

- **Cliente**: Página principal  
- **Empleado**: Panel de gestión limitado  
- **Administrador**: Panel completo  

---

## 🧪 Pruebas

Puedes realizar pruebas manuales desde el navegador utilizando los usuarios de prueba.  
El sistema cuenta con validaciones de formularios en tiempo real y manejo de errores con Livewire.

---

## 🧰 Tecnologías usadas

- **Backend**: Laravel 10, Livewire  
- **Frontend**: Blade, Tailwind CSS, Alpine.js, Sortable.js  
- **Base de datos**: MySQL  

**Librerías adicionales**:

- Spatie Laravel-Permission  
- Laravel Breeze  
- Livewire File Uploads  

---

## ✨ Próximas mejoras

- Sistema de puntos de fidelidad para clientes  
- Códigos de descuento administrables  
- Sistema de reservas de mesas  
- Gestión de proveedores y stock  
- Mejoras responsive en ciertas secciones  

---

## 🧑‍💻 Contribuciones

Las contribuciones están abiertas.  
Puedes enviar un pull request o crear un issue si encuentras algún error o tienes sugerencias.

Si quieres echarle un vistazo, visita nuestra página de preproducción:
https://eldoradojinamar.zapto.org/
