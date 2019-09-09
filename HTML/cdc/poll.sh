#!/bin/bash

cd /var/www/cdc/

now=`date +'%F %T'`
usb=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'usb_panas'"`

#---get pulsa
#pulsa=`sudo bash pulsa.sh`
pulsa="--"


#-----BATTERY
for i in {1..15}; do
	echo -e "Polling ke $i \n"
	get_batt=`python nipress.py "$usb" "$i"`
	if [ ${#get_batt} -lt 10 ]; then
		get_batt=`python nipress.py "$usb" "$i"`
	fi
	c1=`echo $get_batt | cut -d'-' -f20`
	c2=`echo $get_batt | cut -d'-' -f21`
	c3=`echo $get_batt | cut -d'-' -f22`
	c4=`echo $get_batt | cut -d'-' -f23`
	if [ "$c1" == "0" ] && [ "$c2" == "0" ] && [ "$c3" == "0" ] && [ "$c4" == "0" ]; then
		continue
	else
		cons_poll=`php nipress.php "$get_batt" "$pulsa" "$i" "$now"`
	fi
done
