#!/bin/bash

cd /var/www/cdc/

modem=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'modem'"`
usb_kirim=`echo $modem | cut -d',' -f 1`

#-----SET USB MODEM WVDIAL CONFIG

str="[Dialer Defaults]
Modem = $usb_kirim
Baud = 9600
Init1 = ATZ
Init2 = ATQ0 V1 E1 S0=0 &C1 &D2 +FCLASS=0
Init3 = AT+CGDCONT=1,\"IP\",\"internet\"
Stupid Mode = 1
ISDN = 0
Modem Type = Analog Modem
Phone = *99#
Password = wap
Username = wap123
"

echo "$str" > /etc/wvdial.conf

sleep 1
