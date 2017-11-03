FROM bkuhl/fpm-nginx:fpm-7_nginx-1

WORKDIR /var/www/html

# Copy the application files to the container
ADD --chown=www-data:www-data  . /var/www/html

# Run composer as www-data
USER www-data

    # production-ready dependencies
RUN composer install  --no-interaction --optimize-autoloader --no-dev --prefer-dist \

    && rm -rf /home/www-data/.composer/cache \
    && yarn install \
    && yarn run production \
    && yarn cache clean

# add vhost config
ADD ./infrastructure/web/default.conf /etc/nginx/conf.d/default.conf

USER root
