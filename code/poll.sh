#!/bin/bash
cd /home/pi/code
tanggal=`date +'%F %T'`
di=`python /home/pi/di.py`
th=`php temphum.php`
data=""

door=`echo $di | cut -d',' -f1`
ground=`echo $di | cut -d',' -f2`
battlink=`echo $di | cut -d',' -f3`
dcfan=`echo $di | cut -d',' -f4`
ac=`echo $di | cut -d',' -f5`

recti=`php recti.php`
data="$recti"
data=`echo "$tanggal;$data;$th;$door;$ground;$battlink;$dcfan;$ac"`
echo $data
