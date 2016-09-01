FROM realpage/nginx:1.11
MAINTAINER Foundation DevOps foundation-devops@realpage.com
LABEL com.realpage.nginx.version="1.11"

# add the application to the container
ADD ./public /var/www/html/public

# add vhost config
ADD ./infrastructure/nginx/default.conf.template /etc/nginx/conf.d/default.conf.template

# give nginx permission to serve
RUN chown -R nginx:nginx /var/www/html/public

WORKDIR /var/www/html

# Make environment variables available in nginx config - see https://hub.docker.com/_/nginx/
# Required so we can use ${DOLLAR} in default.conf.. using just $ it gets replaced by envsubst
ENV DOLLAR=$
CMD envsubst < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'