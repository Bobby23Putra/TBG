#!/bin/bash

cd /home/pi/wifi
iface=`iw dev | awk '$1=="Interface"{print $2}'`
if [[ "$iface" == "" ]] ;then
        echo "No Interface"
        exit 0
fi

mount -o remount,rw /

sed -i "28s/.*/allow-hotplug $iface/" /etc/network/interfaces
sed -i "29s/.*/iface $iface inet static/" /etc/network/interfaces
sync

ifdown $iface
sleep 1
ifup $iface

sleep 2
mac=`cat /sys/class/net/$iface/address | xargs`
mac=`echo "${mac//:/}"`
mac=`echo "${mac^^}"`

sed -i "1s/.*/ssid=MIOTA_RTU_$mac/" /etc/hostapd.conf
sed -i "2s/.*/interface=$iface/" /etc/hostapd.conf
sed -i "1s/.*/interface=$iface/" /etc/dnsmasq.conf

sudo mount -o remount,ro /

/usr/sbin/service network-manager stop
rfkill unblock $iface
ifup $iface
sleep 2
systemctl restart dnsmasq
sleep 2
nohup /usr/sbin/hostapd /etc/hostapd.conf >/dev/null 2>&1 &
#/usr/sbin/hostapd /etc/hostapd.conf

exit 0
