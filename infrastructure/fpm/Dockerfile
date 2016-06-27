FROM realpage/php:7.0-fpm
LABEL application="laravel" \
      com.realpage.php.version="7.0" \
      com.realpage.php.type="fpm"

# Copy the application files to the container
ADD . /var/www/html

WORKDIR /var/www/html

# Install Composer dependencies
RUN apt-get update && apt-get install -y git zip unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
RUN php /var/www/html/infrastructure/install_composer.php
# parallel dependency installation
RUN composer global require hirak/prestissimo \
    # production-ready dependencies
    && composer install  --no-interaction --no-dev --prefer-dist \

    # give the keys to www-data
    && chown -R www-data:www-data .
