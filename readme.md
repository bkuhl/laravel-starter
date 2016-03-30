## Laravel Service Base Template

This application serves as an API Service base template for developing with [Laravel](https://www.laravel.com).

The project comes pre-configured with a `docker-compose.yaml` that uses Nginx, PHP-FPM and PostgreSQL.  Additionally
the application's `.env` configuration is pre-configured to work with the Docker development environment.

## Development requirements

* [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
* [GIT Version Control client](https://git-scm.com/)

## Steps to run or make changes to the application

1. GIT clone this repo
2. Change directories into the application's root
3. Copy `.env.example` to `.env`
4. Install composer dependencies (`composer install`) either from your local machine in the application root, or from the `fpm` container's cli.
  * Access the `fpm` container's cli with: `docker exec -it $(docker ps -f name=fpm -q) bash`
  * You may want to alias the above as `alias dockerexc='function _docker_exec(){ service=$1; shift; docker exec -it $(docker-compose ps -q ${service}) "$@" };_docker_exec'`
  * The `dockerexc` alias above allows you to type `dockerexc fpm php -v`
5. Run `php artisan migrate --seed` to add your first migration example
6. Check the IP of the docker machine you are running:
  * `docker-machine ip default`
  * It is usually `192.168.99.100`
7. Boot the application container "stack" using Docker Compose
  * `docker-compose up -d`
  * If you'd like to see the log output you can attach to consolidated logs with `docker-compose logs` (`ctrl + c` to exit)
8. Now visit the application in your browser at the docker-machine's IP (i.e. `192.168.99.100`)
9. `docker-compose stop` to stop the application

## Steps to use this template for developing a new application
1. FORK this repo
2. Change directories into the application's root
3. Set an [application key](https://laravel.com/docs/5.2#configuration)
4. Change database credentials
5. Copy `.env.example` to `.env`
6. Install composer dependencies (`composer install`) either from your local machine in the application root, or from the `fpm` container's cli.
  * Access the `fpm` container's cli with: `docker exec -it $(docker ps -f name=fpm -q) bash`
  * You may want to alias the above as `alias dockerexc='function _docker_exec(){ service=$1; shift; docker exec -it $(docker-compose ps -q ${service}) "$@" };_docker_exec'`
  * The `dockerexc` alias above allows you to type `dockerexc fpm php -v`
7. Check the IP of the docker machine you are running:
  * `docker-machine ip default`
  * It is usually `192.168.99.100`
8. Boot the application container "stack" using Docker Compose
  * `docker-compose up -d`
  * If you'd like to see the log output you can attach to consolidated logs with `docker-compose logs` (`ctrl + c` to exit)
9. `php artisan clean:template` to strip out example migrations, seeds, tests, etc...
10. `docker-compose stop` to stop the application