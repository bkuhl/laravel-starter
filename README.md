## Laravel Starter Template [![Build Status](https://travis-ci.org/realpage/laravel-starter.svg?branch=master)](https://travis-ci.org/realpage/laravel-starter)

This [Laravel](https://www.laravel.com) starter template is intended to be used for new projects.

> For details on how to contribute to this repo, please check out the [contributing guide](https://github.com/Realpage/laravel/blob/master/CONTRIBUTING.md).

## README Contents

* [What's Included](#whats-included)
* [Requirements](#requirements)
* [Using This Repository](#using-this-repo)
* [Continuous Integration/Deployment Workflow Diagram](http://realpage.github.io/lumen-starter/ci-cd-foundation-lumen-starter-workflow.png)
* [Roadmap](#roadmap)
* [FAQ](#faq)

<a name="whats-included" />
### What's Included

 * Latest version of Laravel.
 * Pre-configured `docker-compose.yml` that uses nginx, php-fpm and PostgreSQL. ([How can I use MySQL?](#use-mysql))
 * [Travis-CI](https://travis-ci.org) integration:
    * Checks [psr-2 compliance](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) with [phpcs](https://github.com/squizlabs/PHP_CodeSniffer).
    * Runs [phpunit](https://phpunit.de/) tests within docker containers.
    * Pushes deploy-ready containers for `develop`, `staging`, `master` branches to [DockerHub](http://hub.docker.com).
    
<a name="using-this-repo" />
### Using This Repository

We recommend [watching this repository](https://help.github.com/articles/watching-repositories/) so you can apply updates made to this project to yours.

_Realpage teams should contact **foundation-devops@realpage.com** using [this email template](https://github.com/realpage/lumen-starter/wiki) to get everything setup._

For everyone else:

1. Clone this repo and delete the `.git` directory
2. Run `git init` and [change the origin of the repo](https://help.github.com/articles/changing-a-remote-s-url/) to point to your remote repository
3. Reference the [contributing guide](https://github.com/Realpage/laravel/blob/master/CONTRIBUTING.md) for running this application locally
4. `docker exec -it $(docker ps -f name=fpm -q) php artisan clean:template` to strip out example migrations, seeds, tests, etc...

### Development requirements

* [Docker Toolbox](https://www.docker.com/products/docker-toolbox)
* [GIT Version Control client](https://git-scm.com/)

<a name="roadmap" />
### Roadmap

 * Add a cli container for migrations, cli tasks, queue workers, etc.
 * Add cron capabilities to the cli container
 * Add support for elixir to the docker containers
 
<a name="faq" />
### FAQ

<a name="use-mysql" />
##### **How can I use MySQL?**
   * Set the `DB_CONNECTION` environment variable to `mysql`
   * Update the fpm/cli docker containers to `apt-get install php7.0-mysql`

##### **How do I update my nginx config?**
   * the `default.conf` file located in the `infrastructure/nginx` directory will be added to the nginx container as part of the build
   * update the file and rebuild the container via `docker-compose build` to propagate the changes

##### **Is there a shortcut for running commands within specific containers?**

Yes!  [Using an alias](http://askubuntu.com/a/17537/132639) below, you can run commands in containers with `dockerexc fpm php -v` instead of `docker exec -it $(docker ps -f name=fpm -q) php -v`.

```
alias dockerexc='function _docker_exec(){ service=$1; shift; docker exec -it $(docker-compose ps -q ${service}) "$@" };_docker_exec'
```
