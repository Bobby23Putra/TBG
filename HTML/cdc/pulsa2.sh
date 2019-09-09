#!/bin/bash
sudo stty -F /dev/ttyUSB3 9600 cs8 -cooked
cd /var/www/cdc/
log="/var/log/dump_sinyal"
sudo touch $log || exit

echo -e -n "ATZ \015" > /dev/ttyUSB3
sleep 1
sudo cat /dev/ttyUSB3 > $log &
sleep 2
#echo -e "ATZ \015" > /dev/ttyUSB3
echo -e "AT+CUSD=1,\"*888#\",15 \015" > /dev/ttyUSB3
sleep 5
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
