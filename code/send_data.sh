#!/bin/bash

cd /home/pi/code

sudo bash /home/pi/code/wait_serial.sh
sudo python /home/pi/code/send_data.py
