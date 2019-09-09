#!/bin/bash

cd /var/www/cdc/

ins_hasil=`mysql -s -N --user="root" --password="root" --database="cdc" --execute="select poll from log order by id desc limit 0,1"`
echo $ins_hasil

acv1=`echo $ins_hasil | cut -d',' -f1`
acv1=`echo $acv1 | cut -d'=' -f2`
batv=`echo $ins_hasil | cut -d',' -f4`
batv=`echo $batv | cut -d'=' -f2`
rec_cur=`echo $ins_hasil | cut -d',' -f5`
rec_cur=`echo $rec_cur | cut -d'=' -f2`
bat_cur=`echo $ins_hasil | cut -d',' -f6`
bat_cur=`echo $bat_cur | cut -d'=' -f2`
load_cur=`echo $ins_hasil | cut -d',' -f7`
load_cur=`echo $load_cur | cut -d'=' -f2`
bat_temp=`echo $ins_hasil | cut -d',' -f8`
bat_temp=`echo $bat_temp | cut -d'=' -f2`
site=`echo $ins_hasil | cut -d',' -f12`
site=`echo $site | cut -d'=' -f2`

ins_get_info="acv1=$acv1 batv=$batv rec_cur=$rec_cur bat_cur=$bat_cur load_cur=$load_cur bat_temp=$bat_temp site=$site"

#echo $ins_get_info
exec_sms=`sudo bash content_sms.sh "$1" "$ins_get_info" "$2"`
