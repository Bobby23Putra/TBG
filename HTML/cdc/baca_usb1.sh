#!/bin/bash

modem=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'modem'"`
usb_baca=`echo $modem | cut -d',' -f 1`
cd /var/www/cdc
#--cek process di modem port yg sama
	data_read=`ps -ef | grep "wvdial" | grep -v grep`
	while [ "$data_read" != "" ] ; do
		sleep 1
		echo "waiting for usb1 wvdial process to end."
		data_read=`ps -ef | grep "wvdial" | grep -v grep`
	done
	self_read=`ps -ef | grep "python baca_usb1.py" | grep -v grep`
	if [ "$self_read" == "" ] ;then
		sudo python baca_usb1.py "$usb_baca"
	else
		exit
	fi

