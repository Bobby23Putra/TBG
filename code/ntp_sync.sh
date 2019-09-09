#!/bin/bash
cd /var/www/cdc/
#---connect
sudo sh connect.sh start
sleep 2
stat=`sudo bash connect.sh status`
#echo $stat
if [ "$stat" == "Online." ] ;then
	echo "Online"
	echo "sync with server pool.."
	date -s "$(curl -s --head http://google.com | grep ^Date: | sed 's/Date: //g')"
	#sudo service ntp stop
	#sudo ntpd -q -g &
	sleep 3
else
	echo "Offline"
fi
sudo sh connect.sh stop
sleep 1
exit 0
