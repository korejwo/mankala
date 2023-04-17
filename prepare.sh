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
cp .env.example .env

if [ -d "/home/michal" ]; then
  sudo chown -R :phpusers /home/michal/www/mankala/storage
  sudo chown -R :phpusers /home/michal/www/mankala/bootstrap/cache

  if [ ! -d "public/cdn" ]; then
      ln -s /home/michal/www/static/global public/cdn
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
