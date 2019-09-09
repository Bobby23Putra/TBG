#!/bin/bash

HOST="monitoringku.com"

if fping $HOST; then
	rdate -s time.nist.gov
	exit
else
	echo "now connecting..."
	poff -a
	poff -a
	pon
	sleep 20
	echo "recheck using fping"
	if fping $HOST; then
		rdate -s time.nist.gov
		exit
	else
		echo "reseting modem"
		poff -a
		poff -a
		/bin/bash reset_modem.sh
		sleep 15
		pon
		sleep 20
		fping $HOST
	fi
fi
