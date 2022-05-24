# Mustakis - Curso

## Sinopsis

Sistema de administración de cursos, que permite integrar distintas postulaciones a creación y asignación de cursos mediante una plataforma cerrada e integral. Éstas posee un conjunto de 

## Code Example

Show what the library does as concisely as possible, developers should be able to figure out **how** your project solves their problem by looking at the code example. Make sure the API you are showing off is obvious, and that your code is short and concise.

## Instalación

Para correr el proyecto se necesitan los siguientes elementos:

- PHP v7.0 o superior
- Git
- Node
- MySQL
- MongoDB
- npm
- composer

1.- Para descargar el proyecto:
git clone https://gitlab.com/kuantum/mustakis-cursos.git

2.- Hacer una copia de .env.example llamada .env

3.- Ejecutar siguientes comando dentro de la carpeta del proyecto:
- composer install
- npm install
- php artisan key:generate
- php artisan migrate
- php artisan serv

En Windows se requiere de un driver para conectar PHP con MongoDB.

Se debe descargar la DLL (version: Thread Safe (TS)) desde la siguiente URL: https://pecl.php.net/package/mongodb y copiar en el directorio de extensiones de PHP.
En el archivo php.ini se debe insertar la siguiente linea: extension=php_mongodb.dll
Reiniciar servicio Apache o Nginx

4.- Desde un navegador web ir a http://localhost:8000/

## API Reference

Depending on the size of the project, if it is small and simple enough the reference docs can be added to the README. For medium size to larger projects it is important to at least provide a link to where the API reference docs live.

## Tests

Describe and show how to run the tests with code examples.

## Contributors

Let people know how they can dive into the project, include important links to things like issue trackers, irc, twitter accounts if applicable.

## License

A short snippet describing the license (MIT, Apache, etc.)
