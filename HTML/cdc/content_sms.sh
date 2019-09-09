#!/bin/bash

cd /var/www/cdc/
modem=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'modem'"`
usb_kirim=`echo $modem | cut -d',' -f 2`
res=`sudo python send.py "$1" "$2" "$usb_kirim"`
echo $res
if [[ $res == *OK* ]] ;then
	echo "berhasil"
else
	echo "gagal"
	sleep 2
	res2=`sudo python send.py "$1" "$2" "$usb_kirim"`
	if [[ $res2 != *OK* ]] ;then
		outbox=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="insert into outbox (SendingDateTime,DestinationNumber,TextDecoded) values (NOW(),'$1','$2')"`
	fi
fi

