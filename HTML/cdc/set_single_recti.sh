#!/bin/bash

cd /var/www/cdc/
now=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select NOW()"`
site_id=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'site_id'"`
num_server=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'sms_server'"`

recti_ip=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'recti_ip'"`
recti_port=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'recti_port'"`

recti=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="SELECT CONCAT_WS('|',id,param,oid,kali) from oid where param = '$1' order by id asc"`

id=`echo $recti | cut -d'|' -f 1`
nama=`echo $recti | cut -d'|' -f 2`
oid=`echo $recti | cut -d'|' -f 3`
kali=`echo $recti | cut -d'|' -f 4`


hasil=`snmpset -v 1 -c public $recti_ip $oid i $2`; 
if `echo $hasil | grep " = " 1>/dev/null 2>&1` ; then		
	hasil="1";
else
	hasil="0";
fi
echo $hasil
