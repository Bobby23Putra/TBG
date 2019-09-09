#!/bin/bash

cd /home/pi/code

program=`pgrep -f alarm.sh`
if [ ${#program} -lt 1 ]; then
        echo "belum ada, jalankan"
        nohup bash /home/pi/code/alarm.sh > /dev/null 2>&1 &
        #exit 0
else
        echo "sudah ada, exit"
        #exit 0
fi

