## Treda solutions project

En este repositorio se encuentra la prueba técnica realizada por David Garzón Vélez, como prueba de aptitud para la empresa Treda Solutions.

## Requerimientos del proyecto

- composer (https://getcomposer.org/)
- php >=7.0.0

## Instalación del proyecto

Para la instalación del proyecto es necesario ejecutar los siguientes comandos desde la raiz del proyecto.

- composer update
- php artisan db:create
- php artisan migrate --path=database/migrations/Store
- php artisan storage:link

## Ejecución del proyecto

La ruta de ejecución del proyecto se define por:
http://localhost/path_to_project/public/