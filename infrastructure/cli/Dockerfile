# This container should be used for any/all CLI processes
# including cron, queues, etc.
FROM bkuhl/php:7.1

WORKDIR /var/www/html

# Copy the application files to the container
ADD . /var/www/html

# Can be removed once https://github.com/moby/moby/issues/6119 is released
RUN chown -R www-data:www-data /var/www/html /home/www-data

# Run composer as www-data
# Can be moved before application files are added to the container once
# the issue mentioned above is fixed and released
USER www-data

RUN \

    # production-ready dependencies
    composer install  --no-interaction --optimize-autoloader --no-dev --prefer-dist \

    # keep the container light weight
    && rm -rf /home/www-data/.composer/cache