#!/bin/bash
#sudo stty -F /dev/ttyAMA0 9600 cs8 -cooked
cd /home/pi/code

sudo bash /home/pi/code/wait_serial.sh
log=`sudo python /home/pi/code/ussd.py "*888#"`
#sed -i 's/\t//g' $log
#sed -i 's/\r//g' $log
#sed -i 's/OK//g' $log
#xxx=`tail $log`
#pulsa=`echo ${log//\n/}`
pulsa=`echo "|$log|"|tr '\n' ' '`
#echo "1. "$pulsa
#pulsa=`echo $pulsa | cut -d':' -f3`
pulsa=`echo $pulsa | cut -d'.' -f2`
#echo "2. "$pulsa
if [ "$pulsa" -eq "$pulsa" ] 2>/dev/null; then
	pulsa=`echo "scale=3;$pulsa / 1000" | bc -l | sed 's/0\{1,\}$//'`
	if [[ ${pulsa:0:1} == "." ]] ; then pulsa=`echo "0"$pulsa`; fi
	echo $pulsa
else
  echo "--"
fi
