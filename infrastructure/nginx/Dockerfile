FROM realpage/nginx:1.10
MAINTAINER Foundation DevOps foundation-devops@realpage.com
LABEL com.realpage.nginx.version="1.10"

# add the application to the container
COPY ./public /var/www/html/public

# add vhost config
COPY ./infrastructure/nginx/default.conf /etc/nginx/conf.d/default.conf

# give nginx permission to serve
RUN chown -R nginx:nginx /var/www/html/public

WORKDIR /var/www/html