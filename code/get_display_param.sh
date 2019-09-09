#!/bin/bash

cd /home/pi/code

ins_get_info=""

now=`date +'%F %T'`
latest=`/usr/bin/sqlite3 -init <(echo .timeout 5000) /media/data/cdc.db "select waktu from log order by id desc limit 0,1" | xargs`
q_num_pack="select count(*) from log where waktu = '$latest'"
arr_q="select pack_id,bat_volt,bat_cur from log where waktu = '$latest' order by id asc"
num_pack=`/usr/bin/sqlite3 -init <(echo .timeout 5000) /media/data/cdc.db "$q_num_pack" | xargs`
#echo $num_pack
ins_get_info=`echo "$ins_get_info ""Total_Pack=$num_pack"`

arr_data=`/usr/bin/sqlite3 -init <(echo .timeout 5000) /media/data/cdc.db "$arr_q"`
#echo "$arr_data"

while read -r row; do
	if [ "$row" == "" ] ; then continue; fi;
	pack_num=`echo $row | cut -d'|' -f1`
	batv=`echo $row | cut -d'|' -f2`
	batcur=`echo $row | cut -d'|' -f3`
	tmp_batv="#"$pack_num"_Batt_V="$batv
	tmp_batc="#"$pack_num"_Batt_Cur="$batcur
	ins_get_info=`echo "$ins_get_info  $tmp_batv $tmp_batc"`
done <<< "$arr_data"

echo $ins_get_info
