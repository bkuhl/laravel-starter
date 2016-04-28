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
    && php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === '7228c001f88bee97506740ef0888240bd8a760b046ee16db8f4095c0d8d525f2367663f22a46b48d072c816e7fe19959') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \

    # parallel dependency installation
    && composer global require hirak/prestissimo \

    # production-ready dependencies
    && composer install  --no-interaction --no-dev --prefer-dist