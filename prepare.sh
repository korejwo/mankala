#!/bin/sh

if [ ! -d "vendor" ]; then
  export COMPOSER_ALLOW_SUPERUSER=1
  composer install
fi

if [ -d "/home/michal" ]; then
  sudo chown -R www-data.www-data /home/michal/www/mankala/storage
  sudo chown -R www-data.www-data /home/michal/www/mankala/bootstrap/cache

  if [ ! -f "/etc/nginx/sites-enabled/mankala" ]; then
      sudo ln -s /home/michal/www/mankala/nginx_dev.conf /etc/nginx/sites-enabled/mankala
      sudo nginx -s reload
      sudo /etc/init.d/nginx restart
  fi
elif [ -d "/root/dzib" ]; then
  nginx -s reload
  /etc/init.d/nginx restart
fi
