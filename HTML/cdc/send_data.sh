#!/bin/bash

cd /var/www/cdc/
#url variable
gprs_server=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'ip_server'"`
site_id=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select setting_value from setting where setting_name = 'site_id'"`

#echo $site_id

#connecting modem lewat usb1
try1=`sudo bash /var/www/cdc/connect.sh "start"`
#echo "var try1 : "$try1 >> dump_kirim
#try1="Success"
if [[ $try1 == *Success* ]] ; then

	#---BATTERY DATA
	urlcdc="http://$gprs_server/nipress/poll.php"
	echo "collecting battery data..."
	json=`sudo php json.php`
	strflag=`echo ${json} | cut -d'|' -f 1`
	strjson=`echo ${json} | cut -d'|' -f 2`
	if [ ${#strflag} -lt 3 ]; then
		echo "No Data"
		sudo bash connect.sh "stop" "usb1"
		exit
	fi
	echo "site=$site_id&data=$strjson" > tmpcurl
	echo "sending battery data.."
	sendp60=`curl --write-out %{http_code} --silent --connect-timeout 5 --max-time 100 -v -H "Accept: application/json" -X POST -d @tmpcurl "$urlcdc"`
	if [ "$sendp60" == "success&200" ];then
		echo "...sync BATTERY success"
		qr="update log set synced = '1' where id in ($strflag)"
		mysql --user="root" --password="root" --database="cdc" -e "$qr"
	elif [ "$sendp60" == "error&200" ];then
		echo "html transfer ok, but internal server error.. please fix the server code"
		qr="update log set synced = '1' where id in ($strflag)"
		mysql --user="root" --password="root" --database="cdc" -e "$qr"
	else
		echo "...sync BATTERY failed.. retrying.."
		sendp60=`curl --write-out %{http_code} --silent --connect-timeout 5 --max-time 100 -v -H "Accept: application/json" -X POST -d @tmpcurl "$urlcdc"`
	fi
	echo "status transfer : "$sendp60

	echo "Done.. disconnecting.."
	sudo bash connect.sh "stop" "usb1"
	exit
fi
sudo bash connect.sh "stop" "usb1"
