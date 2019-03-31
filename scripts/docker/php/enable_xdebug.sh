#!/usr/bin/env bash

if [ -z "$1" ]; then
    echo "No Remote IP provided. xDebug not configured"
    echo ""
    echo "Usage: $0 IP_OF_HOST_WITH_PHP_STORM"
    exit 1
fi

echo "zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_port=9000
xdebug.remote_handler=\"dbgp\"
xdebug.remote_mode=\"req\"
xdebug.profiler_enable=1
xdebug.idekey=\"PHPSTORM\"
xdebug.remote_host=\"$1\"
xdebug.remote_autostart=1
" > /usr/local/etc/php/conf.d/custom-xdebug.ini

echo "xDebug enabled"

kill -USR2 1