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

### Upgrading Laravel

Objective: Keep an exact mirror of the latest Laravel repo with our changes in top of it.

When upgrading to new major or minor versions of Laravel, do not follow the upgrade guide.  The upgrade guide describes the minimal changes that need to be made to get a project functional on the new version.  To ensure we maintain an exact mirror, here's one method of upgrading this repository: 
 
 * Checkout this repo
 * Create an upgrade branch (e.g. `laravel-5.3-upgrade`)
 * Create a new project for the target version in another directory
 * Overwrite your local branch with the contents of the new project (e.g. - `cp -rf /path/to/new-project /path/to/upgrade/branch`)
 * Use `git diff` to review what's changed and selectively revert/copy over changes to the new files
 * Use `diff --brief -r /path/to/new-project /path/to/upgrade/branch` to compare the fresh laravel project with the starter and analyze that to see which directories/files should be removed from the starter
 * Run `phpunit` and `artisan` to verify nothing's broken