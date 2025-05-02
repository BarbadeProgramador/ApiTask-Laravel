<h1 align="center">✅ API de Tareas – Laravel</h1>


## 📌 Sobre el Proyecto

Este proyecto fue desarrollado como parte de una prueba técnica para la gestión de tareas. Se implementó utilizando **Laravel** junto con **Sanctum** para el manejo de autenticación, y se conecta a una base de datos **SQLite**.  
Incluye endpoints protegidos para crear, listar, actualizar y eliminar tareas de usuarios autenticados.

---

## ⚙️ Tecnologías Utilizadas


<div align="center">

<img src="https://www.php.net/images/logos/new-php-logo.svg" alt="PHP" height="60"/>

<img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" height="60"/>

<img src="https://www.sqlite.org/images/sqlite370_banner.gif" alt="SQLite" height="60"/>

<img src="https://cdn.worldvectorlogo.com/logos/postman.svg" alt="Postman" height="60"/>


</div>

## 🔧 Instalación y Configuración

1. **Clona el repositorio**
   ```bash
   git clone https://github.com/BarbadeProgramador/ApiTask-Laravel
   cd ApiTask-Laravel
   ```

2. **Instala las dependencias**
   ```bash
   composer install
   ```

3. **Configura el archivo de entorno**
   ```bash
   .env.example .env
   ```

4. **Genera la clave de la aplicación**
   ```bash
   php artisan key:generate
   ```

5. **Ejecuta las migraciones y seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Inicia el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

---

## 📄 Documentación

La colección de Postman se encuentra disponible en la carpeta:

```
docs/api
```

Puedes importarla en Postman para probar fácilmente los endpoints.
