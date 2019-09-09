#!/bin/bash

cd /home/pi/code
stat=`pgrep -f read_sms.sh`
while [ ${#stat} -ne 0  ]; do
	#echo "Waiting serial.."
	stat=`pgrep -f read_sms.sh`
	sleep 1
done
#echo "Serial is free. Executing..."
