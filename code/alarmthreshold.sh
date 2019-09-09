#!/bin/bash

cd /home/pi/code

conn=$(/bin/bash connect_gsm.sh)
alive="is alive"

if echo "$conn" | grep -q "$alive"; then
	echo "connected";
	url=`bash mysql "select setting_value from setting where setting_name = 'alarm_url'" | xargs`
	batas=`curl $url`
	bus_v=`echo $batas | cut -d';' -f1`
	bus_c=`echo $batas | cut -d';' -f2`
	load_c=`echo $batas | cut -d';' -f3`
	tempr=`echo $batas | cut -d';' -f4`
	bash mysql "update setting set setting_value = '$bus_v' where setting_name = 'th_bus_v'"
	bash mysql "update setting set setting_value = '$bus_c' where setting_name = 'th_bus_c'"
	bash mysql "update setting set setting_value = '$load_c' where setting_name = 'th_load_c'"
	bash mysql "update setting set setting_value = '$tempr' where setting_name = 'th_tempr'"

else
    echo "no connection";
fi

