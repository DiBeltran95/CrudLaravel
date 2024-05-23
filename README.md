CRUD
Este es un proyecto en Laravel.

Requisitos Previos
Antes de empezar, asegúrate de tener instalado lo siguiente en tu sistema:
 
 -PHP (preferiblemente PHP 8 o superior)
 
 -Composer
 
 -Un servidor de bases de datos compatible con Laravel (MySQL)
 
 -nodejs


INSTALACIÓN

Sigue estos pasos para instalar el proyecto en tu sistema:

* Clona el repositorio: Utiliza el siguiente comando para clonar este repositorio desde GitHub:

git clone https://github.com/DiBeltran95/CrudLaravel

* Accede al directorio del proyecto: Navega al directorio del proyecto recién clonado:

cd CrudLaravel-master

* Instala las dependencias de Composer: Ejecuta el siguiente comando para instalar las dependencias de PHP:

composer install

* Ejecuta las migraciones de la base de datos: Si el proyecto utiliza una base de datos, ejecuta las migraciones para crear las tablas necesarias:

php artisan migrate

EJECUCIÓN
Una vez que el proyecto esté instalado, puedes ejecutarlo localmente usando el servidor integrado de Laravel o cualquier otro servidor web compatible con PHP.

*Para iniciar el servidor de desarrollo de Laravel, ejecuta el siguiente comando desde la raíz del proyecto:

php artisan serve

*Esto iniciará un servidor de desarrollo en http://localhost:8000, donde podrás ver tu aplicación.

PRUEBAS
Para ejecutar las pruebas del proyecto, utiliza el siguiente comando:

php artisan test
