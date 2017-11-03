## Laravel Docker

This [Laravel](https://www.laravel.com) starter template is intended to be used for new projects that utilize Docker for local development and/or production.

<a name="whats-included" />

### What's Included

 * Pre-configured `docker-compose.yml` that uses nginx, php-fpm and MySQL.
 * [`gitlab`](https://github.com/bkuhl/laravel-starter/tree/gitlab) branch for a CI pipeline that builds, tests and pushes containers to the registry.  Add a deploy step to meet your needs and you're done
 * [`travis-ci`](https://github.com/bkuhl/laravel-starter/tree/travis-ci) branch includes examples using [Travis-CI](https://travis-ci.org) for building docker containers, running tests against them and pushing them to Dockerhub.  
 
<a name="using-this-repo" />

### Using This Repository

Take the contents of this repository and drop these files into the root of your project.  Then run the following commands:

 * `docker-compose up` - Brings the containers online.  The fist time through this will build your containers
 * `docker-compose exec web php artisan migrate --seed` - Runs the migrations/seeders from within the docker container
 * Access your site at http://localhost

#### GitLab

No configuration required.

#### Travis-CI & Dockerhub Setup

Create a repository and replace `bkuhl/laravel-starter` with your project's repository information in `.travis-ci.yml` and `docker-compose.yml`.

#### Travis-CI Setup

Configure the following environment variables:
 * `DOCKER_USERNAME`
 * `DOCKER_PASSWORD`

This user needs to have permission to write to the DockerHub repository so that it can push images.

### Development requirements

* [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
* [GIT Version Control client](https://git-scm.com/)