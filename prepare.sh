#!/bin/sh

#sudo groupadd phpusers
#sudo usermod -a -G phpusers michal
#sudo usermod -a -G phpusers www-data

if [ ! -d "vendor" ]; then
  export COMPOSER_ALLOW_SUPERUSER=1
  composer install
  composer dump-autoload
fi

if [ ! -d "socket/node_modules" ]; then
  cd socket
  npm install
  cd ..
fi

chmod 764 bin/chat-server.php

if [ ! -f ".env" ]; then
  cp .env.example .env
  nano .env
  php artisan key:generate
  echo "Enter MySQL root password for database creation"
  mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS mankala"
  echo "Enter MySQL root password for schema import"
  mysql -u root -p mankala < schema.sql
fi

if [ -d "/home/michal" ]; then
#  sudo chown -R :phpusers /home/michal/www/mankala/storage
#  sudo chown -R :phpusers /home/michal/www/mankala/bootstrap/cache
  sudo chmod -R 757 /home/michal/www/mankala/storage
  sudo chmod -R 757 /home/michal/www/mankala/bootstrap/cache

  if [ ! -d "public/cdn" ]; then
      ln -s /home/michal/www/static/global /home/michal/www/mankala/public/cdn
  fi

  if [ ! -f "/etc/nginx/sites-enabled/mankala" ]; then
      sudo ln -s /home/michal/www/mankala/nginx_dev.conf /etc/nginx/sites-enabled/mankala
      sudo nginx -s reload
      sudo /etc/init.d/nginx restart
  fi
elif [ -d "/root/mankala" ]; then
  chmod -R 757 /root/mankala/storage
  chmod -R 757 /root/mankala/bootstrap/cache

  if [ ! -f "/etc/nginx/sites-enabled/mankala" ]; then
    ln -s /root/mankala/nginx_prod.conf /etc/nginx/sites-enabled/mankala
    nginx -s reload
    /etc/init.d/nginx restart
  fi
fi
