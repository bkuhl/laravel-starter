# In CI we'll take the image built off of this commit and tag it so that
# this image will extend it since we can't use $CI_COMMIT_REF_NAME here
FROM project:current-branch-build

# Adding xdebug so we can get code coverage on tests
RUN apk add --update --no-cache g++ make autoconf \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && echo "xdebug.coverage_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && rm -rf /tmp/*