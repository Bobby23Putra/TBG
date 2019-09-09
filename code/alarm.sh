#!/bin/bash

cd /home/pi/code

site_id=`bash mysql "select setting_value from setting where setting_name = 'site_id'" | xargs`
host=`bash mysql "select setting_value from setting where setting_name = 'ip_server'" | xargs`
client_mqtt=`echo "$site_id"_alarm`

th_bus_v=`bash mysql "select setting_value from setting where setting_name = 'th_bus_v'" | xargs`
th_bus_c=`bash mysql "select setting_value from setting where setting_name = 'th_bus_c'" | xargs`
th_load_c=`bash mysql "select setting_value from setting where setting_name = 'th_load_c'" | xargs`
th_tempr=`bash mysql "select setting_value from setting where setting_name = 'th_tempr'" | xargs`

port="1883"
topic="tbg/rtuv1.0/alarm/$site_id"
user="iot"
password="iot"

while [ 1 ];do

#tanggal;ac_volt;bat_cap;bat_cur;bus_v;load_c;load_p;phase_1;phase_2;phase_3;tempr;active_module;failed_module;comm_lost_module;system_power;rec_current;envtemp;envhum;door;ground;battlink;dcfan;ac

data=`bash /home/pi/code/poll.sh`
#NILAI SEKARANG
door=`echo $data | cut -d';' -f19`
ground=`echo $data | cut -d';' -f20`
battlink=`echo $data | cut -d';' -f21`
dcfan=`echo $data | cut -d';' -f22`
ac=`echo $data | cut -d';' -f23`
acv=`echo $data | cut -d';' -f2`
busc=`echo $data | cut -d';' -f4`
busv=`echo $data | cut -d';' -f5`
loadc=`echo $data | cut -d';' -f6`
tempr=`echo $data | cut -d';' -f11`

#NILAI SEBELUMNYA
touch /tmp/alarm_door
touch /tmp/alarm_ground
touch /tmp/alarm_acv
touch /tmp/alarm_busc
touch /tmp/alarm_busv
touch /tmp/alarm_loadc
touch /tmp/alarm_tempr
touch /tmp/alarm_battlink
touch /tmp/alarm_dcfan
touch /tmp/alarm_ac


last_door=`cat /tmp/alarm_door`
last_ground=`cat /tmp/alarm_ground`
last_acv=`cat /tmp/alarm_acv`
last_busc=`cat /tmp/alarm_busc`
last_busv=`cat /tmp/alarm_busv`
last_loadc=`cat /tmp/alarm_loadc`
last_tempr=`cat /tmp/alarm_tempr`
last_battlink=`cat /tmp/alarm_battlink`
last_dcfan=`cat /tmp/alarm_dcfan`
last_ac=`cat /tmp/alarm_ac`



#door
if [[ $door -eq 1 ]];then
        #door closed
	if [[ "$last_door" != "1" ]];then
		data="door=closed"
		send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "1" > /tmp/alarm_door
		echo "DOOR CLOSED"
	fi
else
        #door open
	if [[ "$last_door" != "0" ]];then
		data="door=open"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "0" > /tmp/alarm_door
		echo "DOOR OPEN"
        fi
fi

#ground
if [[ $ground -eq 1 ]];then
        #ground cut
	if [[ "$last_ground" != "0" ]];then
		data="ground=disconnected"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "0" > /tmp/alarm_ground
		echo "GROUND DISCONNECTED"
        fi
else
        #ground connected
	if [[ "$last_ground" != "1" ]];then
		data="ground=connected"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "1" > /tmp/alarm_ground
		echo "GROUND CONNECTED"
        fi
fi

#acv
if [[ $acv -lt 10 ]]; then
	#ac mati
	if [[ "$last_acv" != "0" ]];then
		data="ACV=off"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "0" > /tmp/alarm_acv
		echo "ACV OFF"
        fi
else
	if [[ "$last_acv" != "1" ]];then
		data="ACV=on"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "1" > /tmp/alarm_acv
		echo "ACV ON"
        fi
        #ac hidup
fi

#busv
if [[ $busv -lt $th_bus_v ]]; then
        #low batt
	if [[ "$last_busv" != "0" ]];then
		data="busv=low"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "0" > /tmp/alarm_busv
		echo "BUSV LOW"
        fi
else
	if [[ "$last_busv" != "1" ]];then
		data="busv=normal"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "1" > /tmp/alarm_busv
		echo "BUSV NORMAL"
        fi
        #batt normal
fi

#busc
#if [[ $busc -lt 4600 ]; then
#        #low batt
#else
#        #batt normal
#fi

#tempr
if [[ $tempr -gt $th_tempr ]]; then
        #hightemp
	if [[ "$last_tempr" != "0" ]];then
		data="temperature=high"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "0" > /tmp/alarm_tempr
		echo "TEMPR HIGH"
        fi
else
        #normal
	if [[ "$last_tempr" != "1" ]];then
		data="temperature=normal"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
		echo "1" > /tmp/alarm_tempr
		echo "TEMPR NORMAL"
        fi
fi

#battlink
if [[ $battlink -eq 1 ]]; then
        #hightemp
        if [[ "$last_battlink" != "0" ]];then
                data="battlink=off"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
                echo "0" > /tmp/alarm_battlink
		echo "BATT LINK DISCONNECTED"
        fi
else
        #normal
        if [[ "$last_battlink" != "1" ]];then
                data="battlink=on"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
                echo "1" > /tmp/alarm_battlink
		echo "BATT LINK CONNECTED"
        fi
fi


#dcfan
if [[ $dcfan -eq 1 ]]; then
        #hightemp
        if [[ "$last_dcfan" != "0" ]];then
                data="dcfan=off"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
                echo "0" > /tmp/alarm_dcfan
		echo "DC FAN OFF"
        fi
else
        #normal
        if [[ "$last_dcfan" != "1" ]];then
                data="dcfan=on"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
                echo "1" > /tmp/alarm_dcfan
		echo "DC FAN ON"
        fi
fi

#ac
if [[ $ac -eq 1 ]]; then
        #hightemp
        if [[ "$last_ac" != "0" ]];then
                data="ac=off"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
                echo "0" > /tmp/alarm_ac
		echo "AC OFF"
        fi
else
        #normal
        if [[ "$last_ac" != "1" ]];then
                data="ac=on"
                send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
                echo "1" > /tmp/alarm_ac
		echo "AC ON"
        fi
fi


sleep 5
done
