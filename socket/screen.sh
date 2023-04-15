#!/bin/sh

if [ -d "/home/michal" ]; then
  SOCKET_PATH=/home/michal/www/mankala/
elif [ -d "/root/mankala" ]; then
  SOCKET_PATH=/root/mankala/
fi

screen -dmS mankala -L -Logfile ../storage/logs/socket.log bash -c "cd ${SOCKET_PATH}socket ; ./run.sh"
