#!/bin/bash

cd /var/www/cdc/
sudo bash connect.sh "stop" "usb1"
sudo bash connect.sh "stop" "usb2"
num_server=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'sms_server'"`
poll_value=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select poll from log order by id desc limit 0,1"`

#--kirim lewat modem 1 
kirim=`sudo bash content_sms.sh "$num_server" "$poll_value" "1"`
if [[ $kirim == *berhasil* ]] ;then
	exit
else
	#--kirim lewat modem 2 
	kirim=`sudo bash content_sms.sh "$num_server" "$poll_value" "2"`
fi
