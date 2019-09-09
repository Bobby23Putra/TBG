#!/bin/bash

cd /home/pi/code

modem=""
usb_panas=""
arr=`ls /dev/ttyUSB*`
while read -r usb ; do 
	usba=`echo $usb | cut -d'/' -f 3`;
	hasil=`dmesg | grep $usba | tail -1`
	if [[ $hasil == *GSM* ]] ;then
		#echo "$usb -> modem"
		modem=`echo "$modem$usb,"`
	#elif [[ $hasil == *FTDI* ]] ;then
	elif [[ $hasil == *FTDI* ]] ;then
		#echo "$usb -> panasonic"
		usb_panas=`echo "$usb"`
	elif [[ $hasil == *pl230* ]] ;then
                #echo "$usb -> panasonic"
                usb_panas=`echo "$usb"`
        fi

	#bash /home/pi/code/mysql "update setting set setting_value = '$modem' where setting_name = 'modem'"
	bash /home/pi/code/mysql "update setting set setting_value = '$usb_panas' where setting_name = 'usb_serial'"
done <<< "$arr"

#echo "modem = $modem"
#echo "usb_panas = $usb_panas"
