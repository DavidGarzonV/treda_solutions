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
- php artisan db:seed --class=DatabaseSeeder
- php artisan storage:link

## Ejecución del proyecto

- La ruta de ejecución del proyecto se define por:
http://localhost/path_to_project/public/
Ej: http://localhost/treda_solutions/public/

- Los datos de acceso son:
email: test@test.com
password: 123456

- Url del servicio web:
http://localhost/path_to_project/public/api/products
Ej: http://localhost/treda_solutions/public/api/products

Entrada:
- store_id

Salida: 
- error: En caso de error.
- products: En caso de éxito.

## Log de eventos

Para acceder a log de los servicios web utilizar la siguiente url:

http://127.0.0.1/path_to_project/public/apilogs
Ej: http://127.0.0.1/treda_solutions/public/apilogs

- Para eliminar los logs ejecutar el comando: php artisan apilog:clear