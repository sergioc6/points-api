# Points API

API que permite realizar un CRUD de puntos. También permite obtener los puntos mas cercanos a uno en especifico.
Para instalar es necesario contar con los siguientes softwares
  - git
  - docker
  - docker-compose

## Instalación

Clonar el repositorio

```sh
$ git clone https://github.com/sergioc6/points-api.git
$ cd points-api
```

Copiar las variables de entorno

```sh
$ cp .env.example .env
```

Levantar los servicios

```sh
$ docker-compose up -d
```

Ingresar al servicio de la app y ejecutar migraciones y seeders

```sh
$ docker-compose exec app sh
$ php artisan migrate:fresh --seed
```

La aplicación debe ejecutarse en la URL localhost:80

## API Endopoints

A continuación se detallan los endpoints de la API:

| METHOD | URL | Descripción |
| ------ | ------ | ------ |
| GET | localhost/api/points | Retorna un listado paginado de puntos |
| GET | localhost/api/points/{id} | Retorna un punto por su id |
| POST | localhost/api/points | Crea un nuevo punto |
| PUT | localhost/api/points/{id} | Modifica un punto existente |
| DELETE | localhost/api/points/{id} | Elimina un punto existente |
| GET | localhost/api/points/{id}/nearby | Retorna un listado paginado de puntos cercanos a otro |

## Tests

A continuación se detallarán los pasos para ejecutar los tests de la app.

Ingrese al container de la app.

```sh
$ docker-compose exec app sh
```

Ya dentro del containter ejecutar el siguiente comando

```sh
$ php artisan test
```
