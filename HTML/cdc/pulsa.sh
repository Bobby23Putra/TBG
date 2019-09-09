#!/bin/bash
#sudo stty -F /dev/ttyUSB2 9600 cs8 -cooked
cd /var/www/cdc/

modem=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'modem'"`
usb_kirim=`echo $modem | cut -d',' -f 2`


log="/var/log/dump_sinyal"
sudo touch $log || exit

echo -e -n "ATZ \015" > $usb_kirim
sleep 1
sudo cat $usb_kirim > $log &
sleep 2
#echo -e "ATZ \015" > $usb_kirim
echo -e "AT+CUSD=1,\"*888#\",15 \015" > $usb_kirim
#sleep 5
sleep 3
sudo killall cat
sed -i 's/\t//g' $log
sed -i 's/\r//g' $log
sed -i 's/OK//g' $log
xxx=`tail $log`
pulsa=`echo ${xxx//\n/}`
#pulsa=`echo $pulsa | cut -d':' -f3`
pulsa=`echo $pulsa | cut -d'.' -f2`
if [ "$pulsa" -eq "$pulsa" ] 2>/dev/null; then
	pulsa=`echo "scale=1;$pulsa / 1000" | bc -l`
	if [[ ${pulsa:0:1} == "." ]] ; then pulsa=`echo "0"$pulsa`; fi
	echo $pulsa
else
  echo "--"
fi
sleep 1
