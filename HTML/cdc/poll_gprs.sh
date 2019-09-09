#!/bin/bash

cd /var/www/cdc/

gprs_poll=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'gprs_poll'"`
pc=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'poll_clock'"`

if [ $pc -ge $gprs_poll ] ; then
	echo "file : poll_gprs" >> dump_kirim
	sudo bash send_data.sh
	reset_poll=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="update setting set setting_value = '1' where setting_name = 'poll_clock'"`
else 
	upd_poll=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="update setting set setting_value = setting_value + 1 where setting_name = 'poll_clock'"`
fi
