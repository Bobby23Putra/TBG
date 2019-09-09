#!/usr/bin/env python

import serial
import time
import sys
import os
#import mysqldb
#import minimalmodbus


if os.path.exists(sys.argv[1]) :
	#ser = serial.Serial("/dev/ttyUSB0", 9600, timeout=1)
	ser = serial.Serial(
		port=sys.argv[1],
		baudrate=115200,
		parity=serial.PARITY_NONE,
		stopbits=serial.STOPBITS_TWO,
		bytesize=serial.EIGHTBITS,
		timeout=1
	)
	ser.close()
	ser.open()
	data = ""

	if sys.argv[2] == '1':
		#============================
		#---BATTERY 1
		#vbatt : \x01\x03\x0e\x80\x00\x01\x87\x0a         -9-
		#ibatt : \x01\x03\x0e\x88\x00\x01\x06\xc8         -9-
		#Tmax_module : \x01\x03\x0e\xec\x00\x01\x47\x17   -11-
		#icharge : \x01\x03\x24\xb8\x00\x01\x0e\xdf       -9-
		#idischarge : \x01\x03\x24\xbc\x00\x01\x4f\x1e    -9-
		#SOCavg : \x01\x03\x24\xfa\x00\x01\xae\xcb        -7-
		#Capa_min : \x01\x03\x24\xfc\x00\x01\x4e\xca      -9-
		#SMUs_SOH : \x01\x03\x25\x06\x00\x01\x6f\x07      -15-
		#Alarm_State : \x01\x03\x53\xd0\x00\x01\x94\xb7   -12-
		#Software_V : \x01\x03\x5a\xd0\x00\x01\x97\x2b    -9-

		ser.write("\x01\x10\x00\x04\x00\x02\x04\x00\x00\x00\x00\xF2\x5C")
		sr = ser.read(8)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print ("\n=================== BATT 1 =======================")

		#===VBAT
		ser.write('\x01\x03\x0e\x80\x00\x01\x87\x0a')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Ibat
		ser.write('\x01\x03\x0e\x88\x00\x01\x06\xc8')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Tmax
		ser.write('\x01\x03\x0e\xec\x00\x01\x47\x17')
		sr = ser.read(11)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + str(int((sr[7]+sr[8]).encode('hex'),16)) + "',"

		#===icharge
		ser.write('\x01\x03\x24\xb8\x00\x01\x0e\xdf')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===idischarge
		ser.write('\x01\x03\x24\xbc\x00\x01\x4f\x1e')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SOCavg
		ser.write('\x01\x03\x24\xfa\x00\x01\xae\xcb')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"

		#===Capa_min
		ser.write('\x01\x03\x24\xfc\x00\x01\x4e\xca')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SMUs_SOH
		ser.write('\x01\x03\x25\x06\x00\x01\x6f\x07')
		sr = ser.read(15)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+ str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[9]+sr[10]).encode('hex'),16)) +"."+ str(int((sr[11]+sr[12]).encode('hex'),16)) + "',"

		#===Alarm_state
		#ser.write('\x01\x03\x53\xd0\x00\x01\x94\xb7')
		ser.write('\x01\x03\x5c\xd4\x00\x01\xd6\x62')
		sr = ser.read(40)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+  str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[7]).encode('hex'),16)) + "',"
		data = data + "'" +str(tag)+"',"

		#===Software_ver
		ser.write('\x01\x03\x5a\xd0\x00\x01\x97\x2b')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "'"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===BMU Node ID
		ser.write('\x01\x03\x07\x90\x00\x01\x85\x53')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery Manufacture
		ser.write('\x01\x03\x06\xe5\x00\x01\x95\x75')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery part number
		ser.write('\x01\x03\x06\xe8\x00\x01\x04\xb6')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===Battery serial number
		ser.write('\x01\x03\x06\xec\x00\x01\x45\x77')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "'"
	
		print data

	elif sys.argv[2] == '2':

		#---BATTERY 2
		#vbatt : \x02\x03\x0e\x80\x00\x01\x87\x39         -9-
		#ibatt : \x02\x03\x0e\x88\x00\x01\x06\xFB         -9-
		#Tmax_module : \x02\x03\x0e\xec\x00\x01\x47\x24   -11-
		#icharge : \x02\x03\x24\xb8\x00\x01\x0e\xec       -9-
		#idischarge : \x02\x03\x24\xbc\x00\x01\x4f\x2d    -9-
		#SOCavg : \x02\x03\x24\xfa\x00\x01\xae\xf8        -7-
		#Capa_min : \x02\x03\x24\xfc\x00\x01\x4e\xf9      -9-
		#SMUs_SOH : \x02\x03\x25\x06\x00\x01\x6f\x34      -15-
		#Alarm_State : \x02\x03\x53\xd0\x00\x01\x94\x84   -12-
		#Software_V : \x02\x03\x5a\xd0\x00\x01\x97\x18    -9-
	
		#login
		ser.write("\x02\x10\x00\x04\x00\x02\x04\x00\x00\x00\x00\xFD\x18")
		sr = ser.read(8)
		#init reset
		#ser.write("\x02\x10\x5A\x90\x00\x01\x02\x00\x01\x94\x35")
		    #sr = ser.read(8)
	
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print ("\n=================== BATT 2 =======================")

		#===VBAT
		ser.write('\x02\x03\x0e\x80\x00\x01\x87\x39')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		data = data + "'" + str(tag) + "',"
		data = "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Ibat
		ser.write('\x02\x03\x0e\x88\x00\x01\x06\xFB')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Tmax
		ser.write('\x02\x03\x0e\xec\x00\x01\x47\x24')
		sr = ser.read(11)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + str(int((sr[7]+sr[8]).encode('hex'),16)) + "',"

		#===icharge
		ser.write('\x02\x03\x24\xb8\x00\x01\x0e\xec')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===idischarge
		ser.write('\x02\x03\x24\xbc\x00\x01\x4f\x2d')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SOCavg
		ser.write('\x02\x03\x24\xfa\x00\x01\xae\xf8')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"

		#===Capa_min
		ser.write('\x02\x03\x24\xfc\x00\x01\x4e\xf9')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SMUs_SOH
		ser.write('\x02\x03\x25\x06\x00\x01\x6f\x34')
		sr = ser.read(15)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+ str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[9]+sr[10]).encode('hex'),16)) +"."+ str(int((sr[11]+sr[12]).encode('hex'),16)) + "',"

		#===Alarm_state
		ser.write('\x02\x03\x5c\xd4\x00\x01\xd6\x51')
		sr = ser.read(40)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+  str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[7]).encode('hex'),16)) + "',"
		data = data + "'" +str(tag)+"',"

		#===Software_ver
		ser.write('\x02\x03\x5a\xd0\x00\x01\x97\x18')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "'"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===BMU Node ID
		ser.write('\x02\x03\x07\x90\x00\x01\x85\x60')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery Manufacture
		ser.write('\x02\x03\x06\xe5\x00\x01\x95\x46')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery part number
		ser.write('\x02\x03\x06\xe8\x00\x01\x04\x85')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===Battery serial number
		ser.write('\x02\x03\x06\xec\x00\x01\x45\x44')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "'"
	
		print data

	elif sys.argv[2] == '3':

		#---BATTERY 3
		#vbatt : \x03\x03\x0e\x80\x00\x01\x86\xe8         -9-
		#ibatt : \x03\x03\x0e\x88\x00\x01\x07\x2a         -9-
		#Tmax_module : \x03\x03\x0e\xec\x00\x01\x46\xf5   -11-
		#icharge : \x03\x03\x24\xb8\x00\x01\x0f\x3d       -9-
		#idischarge : \x03\x03\x24\xbc\x00\x01\x4e\xfc    -9-
		#SOCavg : \x03\x03\x24\xfa\x00\x01\xaf\x29        -7-
		#Capa_min : \x03\x03\x24\xfc\x00\x01\x4f\x28      -9-
		#SMUs_SOH : \x03\x03\x25\x06\x00\x01\x6e\xe5      -15-
		#Alarm_State : \x03\x03\x53\xd0\x00\x01\x95\x55   -12-
		#Software_V : \x03\x03\x5a\xd0\x00\x01\x96\xc9    -9-

		ser.write("\x03\x10\x00\x04\x00\x02\x04\x00\x00\x00\x00\xF9\xE4")
		#time.sleep(1)
		sr = ser.read(8)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print ("\n=================== BATT 3 =======================")

		#===VBAT
		ser.write('\x03\x03\x0e\x80\x00\x01\x86\xe8')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Ibat
		ser.write('\x03\x03\x0e\x88\x00\x01\x07\x2a')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Tmax
		ser.write('\x03\x03\x0e\xec\x00\x01\x46\xf5')
		sr = ser.read(11)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + str(int((sr[7]+sr[8]).encode('hex'),16)) + "',"

		#===icharge
		ser.write('\x03\x03\x24\xb8\x00\x01\x0f\x3d')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===idischarge
		ser.write('\x03\x03\x24\xbc\x00\x01\x4e\xfc')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SOCavg
		ser.write('\x03\x03\x24\xfa\x00\x01\xaf\x29')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"

		#===Capa_min
		ser.write('\x03\x03\x24\xfc\x00\x01\x4f\x28')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SMUs_SOH
		ser.write('\x03\x03\x25\x06\x00\x01\x6e\xe5')
		sr = ser.read(15)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+ str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[9]+sr[10]).encode('hex'),16)) +"."+ str(int((sr[11]+sr[12]).encode('hex'),16)) + "',"

		#===Alarm_state
		ser.write('\x03\x03\x5c\xd4\x00\x01\xd7\x80')
		sr = ser.read(40)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+  str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[7]).encode('hex'),16)) + "',"
		data = data + "'" +str(tag)+"',"

		#===Software_ver
		ser.write('\x03\x03\x5a\xd0\x00\x01\x96\xc9')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "'"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===BMU Node ID
		ser.write('\x03\x03\x07\x90\x00\x01\x84\xb1')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery Manufacture
		ser.write('\x03\x03\x06\xe5\x00\x01\x94\x97')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery part number
		ser.write('\x03\x03\x06\xe8\x00\x01\x05\x54')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===Battery serial number
		ser.write('\x03\x03\x06\xec\x00\x01\x44\x95')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "'"
	
		print data

	elif sys.argv[2] == '4':

		#---BATTERY 4
		#vbatt : \x04\x03\x0e\x80\x00\x01\x87\x5f         -9-
		#ibatt : \x04\x03\x0e\x88\x00\x01\x06\x9d         -9-
		#Tmax_module : \x04\x03\x0e\xec\x00\x01\x47\x42   -11-
		#icharge : \x04\x03\x24\xb8\x00\x01\x0e\x8a       -9-
		#idischarge : \x04\x03\x24\xbc\x00\x01\x4f\x4b    -9-
		#SOCavg : \x04\x03\x24\xfa\x00\x01\xae\x9e        -7-
		#Capa_min : \x04\x03\x24\xfc\x00\x01\x4e\x9f      -9-
		#SMUs_SOH : \x04\x03\x25\x06\x00\x01\x6f\x52      -15-
		#Alarm_State : \x04\x03\x53\xd0\x00\x01\x94\xe2   -12-
		#Software_V : \x04\x03\x5a\xd0\x00\x01\x97\x7e    -9-

		ser.write("\x04\x10\x00\x04\x00\x02\x04\x00\x00\x00\x00\xE3\x90")
		#time.sleep(1)
		sr = ser.read(8)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print ("\n=================== BATT 4 =======================")

		#===VBAT
		ser.write('\x04\x03\x0e\x80\x00\x01\x87\x5f')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Ibat
		ser.write('\x04\x03\x0e\x88\x00\x01\x06\x9d')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Tmax
		ser.write('\x04\x03\x0e\xec\x00\x01\x47\x42')
		sr = ser.read(11)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + str(int((sr[7]+sr[8]).encode('hex'),16)) + "',"

		#===icharge
		ser.write('\x04\x03\x24\xb8\x00\x01\x0e\x8a')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===idischarge
		ser.write('\x04\x03\x24\xbc\x00\x01\x4f\x4b')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SOCavg
		ser.write('\x04\x03\x24\xfa\x00\x01\xae\x9e')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"

		#===Capa_min
		ser.write('\x04\x03\x24\xfc\x00\x01\x4e\x9f')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SMUs_SOH
		ser.write('\x04\x03\x25\x06\x00\x01\x6f\x52')
		sr = ser.read(15)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+ str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[9]+sr[10]).encode('hex'),16)) +"."+ str(int((sr[11]+sr[12]).encode('hex'),16)) + "',"

		#===Alarm_state
		ser.write('\x04\x03\x5c\xd4\x00\x01\xd6\x37')
		sr = ser.read(40)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+  str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[7]).encode('hex'),16)) + "',"
		data = data + "'" +str(tag)+"',"
	
		#===Software_ver
		ser.write('\x04\x03\x5a\xd0\x00\x01\x97\x7e')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "'"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===BMU Node ID
		ser.write('\x04\x03\x07\x90\x00\x01\x85\x06')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery Manufacture
		ser.write('\x04\x03\x06\xe5\x00\x01\x95\x20')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery part number
		ser.write('\x04\x03\x06\xe8\x00\x01\x04\xe3')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===Battery serial number
		ser.write('\x04\x03\x06\xec\x00\x01\x45\x22')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "'"
	
		print data

	elif sys.argv[2] == '5':

		#---BATTERY 5
		#vbatt : \x05\x03\x0e\x80\x00\x01\x86\x8e         -9-
		#ibatt : \x05\x03\x0e\x88\x00\x01\x07\x4c         -9-
		#Tmax_module : \x05\x03\x0e\xec\x00\x01\x46\x93   -11-
		#icharge : \x05\x03\x24\xb8\x00\x01\x0f\x5b       -9-
		#idischarge : \x05\x03\x24\xbc\x00\x01\x4e\x9a    -9-
		#SOCavg : \x05\x03\x24\xfa\x00\x01\xaf\x4f        -7-
		#Capa_min : \x05\x03\x24\xfc\x00\x01\x4f\x4e      -9-
		#SMUs_SOH : \x05\x03\x25\x06\x00\x01\x6e\x83      -15-
		#Alarm_State : \x05\x03\x53\xd0\x00\x01\x95\x33   -12-
		#Software_V : \x05\x03\x5a\xd0\x00\x01\x96\xaf    -9-

		ser.write("\x05\x10\x00\x04\x00\x02\x04\x00\x00\x00\x00\xE7\x6C")
		#time.sleep(1)
		sr = ser.read(8)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print ("\n=================== BATT 5 =======================")

		#===VBAT
		ser.write('\x05\x03\x0e\x80\x00\x01\x86\x8e')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Ibat
		ser.write('\x05\x03\x0e\x88\x00\x01\x07\x4c')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Tmax
		ser.write('\x05\x03\x0e\xec\x00\x01\x46\x93')
		sr = ser.read(11)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + str(int((sr[7]+sr[8]).encode('hex'),16)) + "',"

		#===icharge
		ser.write('\x05\x03\x24\xb8\x00\x01\x0f\x5b')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===idischarge
		ser.write('\x05\x03\x24\xbc\x00\x01\x4e\x9a')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SOCavg
		ser.write('\x05\x03\x24\xfa\x00\x01\xaf\x4f')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"

		#===Capa_min
		ser.write('\x05\x03\x24\xfc\x00\x01\x4f\x4e')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SMUs_SOH
		ser.write('\x05\x03\x25\x06\x00\x01\x6e\x83')
		sr = ser.read(15)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+ str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[9]+sr[10]).encode('hex'),16)) +"."+ str(int((sr[11]+sr[12]).encode('hex'),16)) + "',"

		#===Alarm_state
		ser.write('\x05\x03\x5c\xd4\x00\x01\xd7\xe6')
		sr = ser.read(40)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+  str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[7]).encode('hex'),16)) + "',"
		data = data + "'" +str(tag)+"',"

		#===Software_ver
		ser.write('\x05\x03\x5a\xd0\x00\x01\x96\xaf')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "'"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===BMU Node ID
		ser.write('\x05\x03\x07\x90\x00\x01\x84\xd7')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery Manufacture
		ser.write('\x05\x03\x06\xe5\x00\x01\x94\xf1')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery part number
		ser.write('\x05\x03\x06\xe8\x00\x01\x05\x32')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===Battery serial number
		ser.write('\x05\x03\x06\xec\x00\x01\x44\xf3')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "'"
	
		print data

	elif sys.argv[2] == '6':

		#---BATTERY 6
		#vbatt : \x06\x03\x0e\x80\x00\x01\x86\xbd         -9-
		#ibatt : \x06\x03\x0e\x88\x00\x01\x07\x7f         -9-
		#Tmax_module : \x06\x03\x0e\xec\x00\x01\x46\xa0   -11-
		#icharge : \x06\x03\x24\xb8\x00\x01\x0f\x68       -9-
		#idischarge : \x06\x03\x24\xbc\x00\x01\x4e\xa9    -9-
		#SOCavg : \x06\x03\x24\xfa\x00\x01\xaf\x7c        -7-
		#Capa_min : \x06\x03\x24\xfc\x00\x01\x4f\x7d      -9-
		#SMUs_SOH : \x06\x03\x25\x06\x00\x01\x6e\xb0      -15-
		#Alarm_State : \x06\x03\x53\xd0\x00\x01\x95\x00   -12- ???
		#Software_V : \x06\x03\x5a\xd0\x00\x01\x96\x9c    -9-

		ser.write("\x06\x10\x00\x04\x00\x02\x04\x00\x00\x00\x00\xE8\x28")
		#time.sleep(1)
		sr = ser.read(8)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print ("\n=================== BATT 6 =======================")

		#===VBAT
		ser.write('\x06\x03\x0e\x80\x00\x01\x86\xbd')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Ibat
		ser.write('\x06\x03\x0e\x88\x00\x01\x07\x7f')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===Tmax
		ser.write('\x06\x03\x0e\xec\x00\x01\x46\xa0')
		sr = ser.read(11)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + str(int((sr[7]+sr[8]).encode('hex'),16)) + "',"

		#===icharge
		ser.write('\x06\x03\x24\xb8\x00\x01\x0f\x68')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===idischarge
		ser.write('\x06\x03\x24\xbc\x00\x01\x4e\xa9')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SOCavg
		ser.write('\x06\x03\x24\xfa\x00\x01\xaf\x7c')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"

		#===Capa_min
		ser.write('\x06\x03\x24\xfc\x00\x01\x4f\x7d')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"

		#===SMUs_SOH
		ser.write('\x06\x03\x25\x06\x00\x01\x6e\xb0')
		sr = ser.read(15)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+ str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[9]+sr[10]).encode('hex'),16)) +"."+ str(int((sr[11]+sr[12]).encode('hex'),16)) + "',"

		#===Alarm_state
		ser.write('\x06\x03\x5c\xd4\x00\x01\xd7\xd5')
		sr = ser.read(40)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) +"."+  str(int((sr[7]+sr[8]).encode('hex'),16)) +"."+ str(int((sr[7]).encode('hex'),16)) + "',"
		data = data + "'" +str(tag)+"',"

		#===Software_ver
		ser.write('\x06\x03\x5a\xd0\x00\x01\x96\x9c')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "'"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===BMU Node ID
		ser.write('\x06\x03\x07\x90\x00\x01\x84\xe4')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery Manufacture
		ser.write('\x06\x03\x06\xe5\x00\x01\x94\xc2')
		sr = ser.read(7)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		#data = data + "'" +str(int((sr[3]).encode('hex'),16)) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) + "',"
	
		#===Battery part number
		ser.write('\x06\x03\x06\xe8\x00\x01\x05\x01')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "',"
	
		#===Battery serial number
		ser.write('\x06\x03\x06\xec\x00\x01\x44\xc0')
		sr = ser.read(9)
		#ser.close()
		tag='-'.join(x.encode('hex') for x in sr)
		#print tag
		#data = data + "'" + str(tag) + "',"
		data = data + "'" +str(int((sr[3]+sr[4]).encode('hex'),16)) +"."+ str(int((sr[5]+sr[6]).encode('hex'),16)) + "'"
	
		print data

	else :
		print "Pilih ID Battery"
else :
	print "'','','','','','','','','','','','','',''"

