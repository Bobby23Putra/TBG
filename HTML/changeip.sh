#!/bin/bash
sed -i "6s/.*/address $1/" /etc/network/interfaces
sed -i "7s/.*/netmask 255.255.255.0/" /etc/network/interfaces
sed -i "8s/.*/gateway $2/" /etc/network/interfaces

sync
shutdown -r now

