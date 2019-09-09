#!/bin/bash

#usb current limit
/usr/local/bin/gpio -g mode 38 out
/usr/local/bin/gpio -g write 38 1
/usr/local/bin/gpio -g read 38

cd /var/www/cdc

modem=""
usb_panas=""
arr=`ls /dev/ttyUSB*`
while read -r usb ; do 
	usba=`echo $usb | cut -d'/' -f 3`;
	hasil=`dmesg | grep $usba | tail -1`
	if [[ $hasil == *GSM* ]] ;then
		#echo "$usb -> modem"
		modem=`echo "$modem$usb,"`
	#elif [[ $hasil == *FTDI* ]] ;then
	elif [[ $hasil == *FTDI* ]] ;then
		#echo "$usb -> panasonic"
		usb_panas=`echo "$usb"`
	fi
	bash /var/www/cdc/mysql "update setting set setting_value = '$modem' where setting_name = 'modem'"
	bash /var/www/cdc/mysql "update setting set setting_value = '$usb_panas' where setting_name = 'usb_panas'"
done <<< "$arr"

echo "modem = $modem"
echo "usb_panas = $usb_panas"
