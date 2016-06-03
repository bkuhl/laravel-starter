FROM realpage/php:7.0-fpm
LABEL version="1.0.0-beta" \
      application="laravel" \
      com.realpage.php.version="7.0" \
      com.realpage.php.type="fpm" \
      com.realpage.php.composer.version="1.0.0"

# Copy the application files to the container
ADD . /var/www/html

WORKDIR /var/www/html

# Install Composer
RUN apt-get update && apt-get install -y git zip unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \

    # this hash needs to be updated with each composer version release
    && php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === '070854512ef404f16bac87071a6db9fd9721da1684cd4589b1196c3faf71b9a2682e2311b36a5079825e155ac7ce150d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \

    # parallel dependency installation
    && composer global require hirak/prestissimo \

    # production-ready dependencies
    && composer install  --no-interaction --no-dev --prefer-dist \

    # give the keys to www-data
    && chown -R www-data:www-data .