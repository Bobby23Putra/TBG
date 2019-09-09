#!/bin/bash
cd /home/pi/code

site_id=`bash mysql "select setting_value from setting where setting_name = 'site_id'" | xargs`
host=`bash mysql "select setting_value from setting where setting_name = 'ip_server'" | xargs`
client_mqtt=`echo "$site_id"_data`
tanggal=`date +'%F %T'`
#curr_a, curr_b, curr_c, curr_n, volt_ab, volt_bc, volt_ac, volt_an, volt_bn, volt_cn, freq_

#memastikan koneksi gsm
conn=$(/bin/bash connect_gsm.sh)
alive="is alive"

if echo "$conn" | grep -q "$alive"; then
    echo "connected";
else
    echo "no connection";
fi


data=`bash poll.sh`
echo $data

#mqtt
port="1883"
topic="tbg/rtuv1.0/data/$site_id"
user="iot"
password="iot"
send=`mosquitto_pub -q 1 -h $host -p $port -t $topic -m "$data" -u $user -P $password -i $client_mqtt -d`
sync

