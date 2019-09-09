#!/bin/bash

cd /home/pi/code

now=`date +'%F %T'`
setting=`/usr/bin/sqlite3 -init <(echo .timeout 5000) /media/data/cdc.db "select setting_name,setting_value from setting"`
all=""

while read -r line; do
    param=`echo $line | cut -d'|' -f1`
	val=`echo $line | cut -d'|' -f2`
	all="$all $param=$val"
done <<< "$setting"

echo $all
