#!/bin/bash

DAYS="30"
# GET CURRENT DATETIME
CURRENTDATE=`date +"%F %T"`

# GENERATE PAST DATE FROM DAYS CONSTANT
OLDERDATE=`date +"%F %T" -d "$DAYS days ago"`

#echo "$CURRENTDATE --- $OLDERDATE"
query="delete from log where strftime('%s', waktu) < strftime('%s', '$OLDERDATE')"
sudo bash /home/pi/code/mysql "$query"

query2="delete from alarm where strftime('%s', waktu) < strftime('%s', '$OLDERDATE')"
sudo bash /home/pi/code/mysql "$query2"

#echo $query
