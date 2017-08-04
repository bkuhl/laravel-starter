## Laravel Starter Template [![Build Status](https://travis-ci.org/realpage/laravel-starter.svg?branch=master)](https://travis-ci.org/realpage/laravel-starter)

This [Laravel](https://www.laravel.com) starter template is intended to be used for new projects that utilize Docker for local development and/or production.v

<a name="whats-included" />

### What's Included

 * Latest version of Laravel.
 * Pre-configured `docker-compose.yml` that uses nginx, php-fpm and MySQL.
 * [Travis-CI](https://travis-ci.org) integration
 
<a name="using-this-repo" />

### Using This Repository

We recommend [watching this repository](https://help.github.com/articles/watching-repositories/) so you can apply updates made to this project to yours.

#### Dockerhub Setup

Create a repository and replace `bkuhl/laravel-starter` with your project's repository information in `.travis-ci.yml` and `docker-compose.yml`.

#### Travis-CI Setup

Configure the following environment variables:
 * `DOCKER_USERNAME`
 * `DOCKER_PASSWORD`

This user needs to have permission to write to the DockerHub repository so that it can push images.

### Development requirements

* [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
* [GIT Version Control client](https://git-scm.com/)