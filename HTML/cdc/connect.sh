#!/bin/bash

cd /var/www/cdc
echo "nameserver 8.8.8.8" > /etc/resolv.conf
test -x $DAEMON || exit 0
gprs_server=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'ip_server'"`
#--cek process di modem port yg sama
if [ "$2" == "usb1" ] ;then
	proc_read=`ps -ef | grep "python /var/www/cdc/baca_usb1.py" | grep -v grep`
	while [ "$proc_read" != "" ] ; do
		sleep 1
		echo "waiting for usb1 reading process to end."
		proc_read=`ps -ef | grep "python /var/www/cdc/baca_usb1.py" | grep -v grep`
	done
elif [ "$2" == "usb2" ] ;then
	proc_read=`ps -ef | grep "python /var/www/cdc/baca_usb2.py" | grep -v grep`
	while [ "$proc_read" != "" ] ; do
		sleep 1
		echo "waiting for usb2 reading process to end."
		proc_read=`ps -ef | grep "python /var/www/cdc/baca_usb2.py" | grep -v grep`
	done
fi
case "$1" in
	start)
		echo "Starting Connection..."  
		#sudo nohup wvdialconf > /dev/null 2>&1
		#sleep 4
		sudo nohup wvdial > /dev/null 2>&1 &
		sleep 8
		wget -q --tries=3 --timeout=3 -O - http://$gprs_server > /dev/null
		if [ $? -eq 0 ] ;then
			sudo date -s "$(curl -s http://$gprs_server/gspe/date.php )"
			echo "Connect Success."
			exit 1
		else
			echo "Failed to connect.. Reconnecting.."
			sudo nohup killall pppd > /dev/null 2>&1 &
			sudo nohup killall wvdial > /dev/null 2>&1 &
			sleep 2
			#sudo nohup wvdialconf > /dev/null 2>&1
			#sleep 4
			sudo nohup wvdial > /dev/null 2>&1 &
			sleep 8
			wget -q --tries=3 --timeout=3 -O - http://$gprs_server > /dev/null
			if [ $? -eq 0 ] ;then
				sudo date -s "$(curl -s http://$gprs_server/gspe/date.php )"
				echo "Connect Success."
				mysql -s -N --user="root" --password="root" --database="cdc" --execute="update setting set setting_value = '1' where setting_name = 'clock_modem'"
				exit 0
			else
				echo "Cannot connect"
				sudo nohup killall pppd > /dev/null 2>&1 &
				sudo nohup killall pppd > /dev/null 2>&1 &
				sudo nohup killall wvdial > /dev/null 2>&1 &
				sudo nohup killall wvdial > /dev/null 2>&1 &
				
				#--bila 5 kali berturut2 , reboot
				#mysql -s -N --user="root" --password="root" --database="cdc" --execute="update setting set setting_value = setting_value + 1 where setting_name = 'clock_modem'"
				#clock=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'clock_modem'"`
				#if [ $clock -ge 5 ] ;then
				#	/sbin/shutdown -r now
				#fi 
				exit 0
			fi
		fi
	;;
	stop)  
			echo "Stopping Connection..."  
			sudo nohup killall pppd > /dev/null 2>&1 &
			sudo nohup killall pppd > /dev/null 2>&1 &
			sudo nohup killall wvdial > /dev/null 2>&1 &
			sudo nohup killall wvdial > /dev/null 2>&1 &
			exit 1
	;;
	status)
			wget -q --tries=3 --timeout=3 -O - http://$gprs_server > /dev/null
			if [ $? -eq 0 ] ;then
				echo "Online."
				exit 1
			else
				echo "Ofline"
				exit 1
			fi
	;;
	
	*)
	   echo "Connection Manager"
       echo $"Usage: $0 {start|stop|status}"
       exit 1
esac
exit 0
