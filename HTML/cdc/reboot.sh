#!/bin/bash

cd /var/www/cdc
gen_mode=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'genset_mode'"`
if [ "$gen_mode" == "fail" ] ;then
	exit
else
	sync; sync; sync; 
	sleep 30; 
	sudo shutdown -r now
	exit
fi
