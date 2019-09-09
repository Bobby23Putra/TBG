#!/bin/bash

cd /home/pi/code

sr=`sudo bash /home/pi/pi_version.sh`
sr=`echo $sr | xargs`

stat=`lsof $sr`
while [ ${#stat} -ne 0  ]; do
	#echo "Waiting serial.."
	stat=`lsof $sr`
	sleep 1
done
#echo "Serial is free. Executing..."
