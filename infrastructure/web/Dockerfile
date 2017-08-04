FROM bkuhl/fpm-nginx:fpm-7_nginx-1

WORKDIR /var/www/html

# Copy the application files to the container
ADD . /var/www/html

# For some reason Travis-CI adds files to the container with incorrect permissions
RUN sed -ri 's/^www-data:x:82:82:/www-data:x:1000:1000:/' /etc/passwd \
    && sed -ri 's/^www-data:x:82:/www-data:x:1000:/' /etc/group

# Can be removed once https://github.com/moby/moby/issues/6119 is released
RUN chown -R www-data:www-data /var/www/html /home/www-data

# Run composer as www-data
# Can be moved before ADD once the Chown's issue is released
USER www-data

RUN \

    # production-ready dependencies
    composer install  --no-interaction --optimize-autoloader --no-dev --prefer-dist \

    && rm -rf /home/www-data/.composer/cache

# add vhost config
ADD ./infrastructure/web/default.conf /etc/nginx/conf.d/default.conf

USER root