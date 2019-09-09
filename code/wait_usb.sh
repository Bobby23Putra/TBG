#!/bin/bash

cd /home/pi/code

sr=`bash /home/pi/code/mysql "select setting_value from setting where setting_name = 'usb_serial'" | xargs`
if [ ${#sr} -eq 0 ];then
	exit
fi
stat=`lsof $sr`
while [ ${#stat} -ne 0  ]; do
	#echo "Waiting serial.."
	stat=`lsof $sr`
	sleep 1
done
#echo "Serial is free. Executing..."
