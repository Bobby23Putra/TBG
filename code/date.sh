#!/bin/bash
mount -o remount,rw /
latest=`bash /home/pi/code/mysql "select waktu from tmp_alarm order by waktu desc limit 0,1" | xargs`
#echo $latest
date -s "$latest"
mount -o remount,ro /
