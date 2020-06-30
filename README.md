# Points API

API que permite realizar un CRUD de puntos. También permite obtener los puntos mas cercanos a uno en especifico.
Para instalar es necesario contar con los siguientes softwares
  - git
  - docker
  - docker-compose

## Instalación

Clonar el repositorio
```sh
$ cd dillinger
$ npm install -d
$ node app
```

For production environments...

```sh
$ npm install --production
$ NODE_ENV=production node app
```

## API Endopoints

A continuación se detallan los endpoints de la API:

| METHOD | URL | Descripción |
| ------ | ------ | ------ |
| GET | localhost/api/points | |
| GET | localhost/api/points/{id} | |
| POST | localhost/api/points | |
| PUT | localhost/api/points/{id} | |
| DELETE | localhost/api/points/{id} | |
| GET | localhost/api/points/{id}/nearby | |

## Tests

Want to contribute? Great!

Dillinger uses Gulp + Webpack for fast developing.
Make a change in your file and instantaneously see your updates!

Open your favorite Terminal and run these commands.

First Tab:
```sh
$ node app
```

Second Tab:
```sh
$ gulp watch
```
