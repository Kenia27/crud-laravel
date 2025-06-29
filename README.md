# CRUD de Usuarios en Laravel

Este proyecto implementa un sistema de gestión de usuarios utilizando Laravel, Livewire y Volt. Permite registrar usuarios, autenticarse, gestionar su información y realizar operaciones básicas de CRUD sobre el perfil.

## Requisitos

- PHP >= 8.2
- Composer
- Node.js y npm
- MySQL, PostgreSQL o SQLite
- Laravel 12

## Instalación

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/Kenia27/crud-laravel.git
   cd crud-laravel
   
2. Instalar dependencias:

   ```bash
   composer install
   npm install && npm run dev
   
3. Configurar entorno:

    ```bash
   cp .env.example .env
   php artisan key:generate
   
4. Configurar BD en .env y ejecutar migraciones:

   ```bash
    php artisan migrate
   
5. Iniciar el servidor de desarrollo:

   ```bash
   php artisan serve


Características
- Registro y autenticación de usuarios
- Validación de correo electrónico
- Edición de perfil con Livewire
- Gestión de número telefónico con validación
- Interfaz modular con componentes personalizados
  
Estructura
El proyecto sigue la estructura estándar de Laravel con integración de Livewire Volt para componentes dinámicos.

   
