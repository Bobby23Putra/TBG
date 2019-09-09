#!/bin/bash

if [[ "$1" == "add" ]] ;then
	sudo bash /home/pi/code/mysql "insert into user (username,password) values ('$2','$3')"
elif [[ "$1" == "delete" ]] ;then
	if [[ "$2" == "1" ]];then
		exit
	else
		sudo bash /home/pi/code/mysql "delete from user where id = '$2'"
	fi
elif [[ "$1" == "update" ]] ;then
	sudo bash /home/pi/code/mysql "update user set password = '$3' where id = '$2'"
fi
