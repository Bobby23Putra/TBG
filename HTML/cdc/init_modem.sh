#!/bin/bash
cd /var/www/cdc
while [ -e /dev/ttyUSB1 ] ; do
  # wait to be registered
  if ./operator | grep -q ','; then
    wvdial provider >> wvdial.log 2>&1
  fi
  sleep 1
done
