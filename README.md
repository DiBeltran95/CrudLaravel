<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# GESTIÓN DE EMPLEADOS
Prueba de Conocimientos para Desarrollador de Software PERFIL1

# Requisitos Previos
> [!IMPORTANT]
> Antes de empezar, asegúrate de tener instalado lo siguiente en tu sistema:
 
 - PHP (preferiblemente PHP 8 o superior) <a href="https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe">XAMPP</a>
 
 - Composer <a href="https://getcomposer.org/Composer-Setup.exe">Composer</a>
 
 - Un servidor de bases de datos compatible con Laravel (MySQL) si instalas XAMP ya este lo incluye.
 
 - nodejs  <a href="https://nodejs.org/dist/v20.13.1/node-v20.13.1-x64.msi">NodeJS</a>


# INSTALACIÓN

Sigue estos pasos para instalar el proyecto en tu sistema:

* Clona el repositorio: Utiliza el siguiente comando para clonar este repositorio desde GitHub:
```
git clone https://github.com/DiBeltran95/CrudLaravel
```
* Accede al directorio del proyecto: Navega al directorio del proyecto recién clonado:
```
cd CrudLaravel-master
```
* Instala las dependencias de Composer: Ejecuta el siguiente comando para instalar las dependencias de PHP:
```
composer install
```
* Ejecuta las migraciones de la base de datos: Hay que modificar el archivo .env en la raíz del proyecto, en el cual hay que poner las credenciales de la base de datos, luego ejecuta las migraciones para crear la base de datos:
```
php artisan migrate
```

# EJECUCIÓN

Una vez que el proyecto esté instalado, puede ejecutar localmente, teniendo encuenta que debe tener encendido XAMP o cualquier otro servidor que tenga php y MySQL.

* Para iniciar el servidor de desarrollo de Laravel, ejecuta el siguiente comando desde la raíz del proyecto:
```
php artisan serve
```
* Esto iniciará un servidor de desarrollo en http://localhost:8000, donde podrás ver tu aplicación.


# PRUEBAS

Para ejecutar las pruebas del proyecto, utiliza el siguiente comando:
```
php artisan test
```
# Vista Departamentos
![Captura2](https://github.com/DiBeltran95/CrudLaravel/assets/31999241/bf9a2fc4-8bbb-4efa-926a-5244084c8dcf)

# CRUD Departamentos
<p align="center"> <img src="https://github.com/DiBeltran95/CrudLaravel/assets/31999241/bb174f32-0d6e-4e35-987c-113fe94148c8" width="700"> </p>

# Vista Empleados
![Captura1](https://github.com/DiBeltran95/CrudLaravel/assets/31999241/dcdb014a-dadc-4e60-bd83-a662e98838ad)

# CRUD Empleados
<p align="center"> <img src="https://github.com/DiBeltran95/CrudLaravel/assets/31999241/706304aa-386e-438d-a532-0f37ed3f34e2" width="700"> </p>


