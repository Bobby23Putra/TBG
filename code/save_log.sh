#!/bin/bash

cd /home/pi/code

log_period=`bash /home/pi/code/mysql "select setting_value from setting where setting_name = 'log_period'" | xargs`
log_clock=`bash /home/pi/code/mysql "select setting_value from setting where setting_name = 'log_clock'" | xargs`
echo "Period : $log_period, Clock : $log_clock"
if [ $log_clock -ge $log_period ];then
	qid_data=`bash /home/pi/code/mysql "select qid from tmp_log where pack_id = '1' order by waktu desc limit 0,1" | xargs`
	#qid_alarm=`bash /home/pi/code/mysql "select qid from tmp_alarm where pack_id = '1' order by waktu desc limit 0,1" | xargs`
	loop_pack=`bash /home/pi/code/mysql "select pack_id from tmp_log where qid = '$qid_data' order by id asc" | xargs`
	for i in `echo $loop_pack` ;do
		#--save data log
		ins=`bash /home/pi/code/mysql "insert into log (waktu,site_id,pack_id,cell_1,cell_2,cell_3,cell_4,cell_5,cell_6,cell_7,cell_8,cell_9,cell_10,cell_11,cell_12,cell_13,cell_14,cell_15,cell_16,temp_1,temp_2,temp_3,temp_4,temp_5,temp_6,temp_7,temp_8,temp_9,temp_10,temp_11,temp_12,temp_13,temp_14,temp_15,temp_16,temp_mossfet,temp_env,bat_cur,bat_volt,soc,full_cap,cycle_count,des_cap,balance,qid) select waktu,site_id,pack_id,cell_1,cell_2,cell_3,cell_4,cell_5,cell_6,cell_7,cell_8,cell_9,cell_10,cell_11,cell_12,cell_13,cell_14,cell_15,cell_16,temp_1,temp_2,temp_3,temp_4,temp_5,temp_6,temp_7,temp_8,temp_9,temp_10,temp_11,temp_12,temp_13,temp_14,temp_15,temp_16,temp_mossfet,temp_env,bat_cur,bat_volt,soc,full_cap,cycle_count,des_cap,balance,qid from tmp_log where qid = '$qid_data' and pack_id = '$i'"`
		#--save alarm log
		#ins=`bash /home/pi/code/mysql "insert into alarm (waktu,site_id,pack_id,cell_1,cell_2,cell_3,cell_4,cell_5,cell_6,cell_7,cell_8,cell_9,cell_10,cell_11,cell_12,cell_13,cell_14,cell_15,cell_16,temp_1,temp_2,temp_3,temp_4,temp_5,temp_6,temp_7,temp_8,temp_9,temp_10,temp_11,temp_12,temp_13,temp_14,temp_15,temp_16,temp_mossfet,temp_env,bat_cur,bat_volt,dis_cur,status_1,status_2,status_3,status_4,status_5,status_6,status_7,status_8,status_9,qid) select waktu,site_id,pack_id,cell_1,cell_2,cell_3,cell_4,cell_5,cell_6,cell_7,cell_8,cell_9,cell_10,cell_11,cell_12,cell_13,cell_14,cell_15,cell_16,temp_1,temp_2,temp_3,temp_4,temp_5,temp_6,temp_7,temp_8,temp_9,temp_10,temp_11,temp_12,temp_13,temp_14,temp_15,temp_16,temp_mossfet,temp_env,bat_cur,bat_volt,dis_cur,status_1,status_2,status_3,status_4,status_5,status_6,status_7,status_8,status_9,qid from tmp_alarm where qid = '$qid_alarm' and pack_id = '$i'"`
	done

	reset_poll=`bash /home/pi/code/mysql "update setting set setting_value = '1' where setting_name = 'log_clock'"`
else
	upd_poll=`bash /home/pi/code/mysql "update setting set setting_value = setting_value + 1 where setting_name = 'log_clock'"`
fi
