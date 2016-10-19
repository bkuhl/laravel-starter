FROM realpage/nginx:1.11
MAINTAINER Foundation DevOps foundation-devops@realpage.com
LABEL com.realpage.nginx.version="1.11"

# add the application to the container
ADD ./public /var/www/html/public

# add vhost config
ADD ./infrastructure/nginx/default.conf /etc/nginx/conf.d/default.conf

# give nginx permission to serve
RUN chown -R nginx:nginx /var/www/html/public

WORKDIR /var/www/html