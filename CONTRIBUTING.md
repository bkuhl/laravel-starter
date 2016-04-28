# Running locally

1. GIT clone this repo
2. Setup local environment vars by running `cp .env.example .env` (already works with docker-compose)
3. Start the Docker VM by running `docker-machine start default` 
4. Boot the application container "stack" using Docker Compose by running `docker-compose up -d` (`-d` runs containers in the background)

> If you'd like to see the log output you can attach to consolidated logs with `docker-compose logs` (`ctrl + c` to exit)

5. Install composer dependencies by running `docker exec -it $(docker-compose ps -q fpm) composer install`, or [use the shortcut](https://github.com/realpage/lumen/tree/readme-updates#is-there-a-shortcut-for-running-commands-within-specific-containers)

> Utilizing `docker exec` all the time can be a pain.  We've added [some artisan commands](https://github.com/Realpage/builder) to this project that'll make dependecies less of a pain to install/update.

Note: Elixir/Gulp is not yet supported

6. Run `docker exec -it $(docker ps -f name=fpm -q) php artisan migrate --seed` (or [use the shortcut](https://github.com/realpage/lumen/tree/readme-updates#is-there-a-shortcut-for-running-commands-within-specific-containers) ) to migrate and seed the database
7. Now visit the application at http://192.168.99.100 (the docker-machine's default IP)