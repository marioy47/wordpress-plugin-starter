# Make things cleaner by saving this path on a variable

# cSpell:ignore pecl
ARG WORDPRESS_IMAGE="wordpress:6-apache"

FROM $WORDPRESS_IMAGE

# Install, enable and configure xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

ARG XDEBUG_INI="/usr/local/etc/php/conf.d/xdebug.ini"
RUN echo "[xdebug]" > $XDEBUG_INI \
    && echo "xdebug.mode = debug" >> $XDEBUG_INI \
    && echo "xdebug.start_with_request = trigger" >> $XDEBUG_INI \
    && echo "xdebug.client_port = 9003" >> $XDEBUG_INI \
    && echo "xdebug.client_host = 'host.docker.internal'" >> $XDEBUG_INI \
    && echo "xdebug.log = /tmp/xdebug.log" >> $XDEBUG_INI

