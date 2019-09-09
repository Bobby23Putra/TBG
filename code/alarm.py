#!/usr/bin/env python

import serial
import time
import sys
import os

#def crc(str):
#       x=0x2D1
#       val = (0xffff - (x % 0x10000)) + 1
#       return hex(val)[2:]


if os.path.exists(sys.argv[1]) :
        ser = serial.Serial(
                port=sys.argv[1],
                baudrate=9600,
                parity=serial.PARITY_NONE,
                stopbits=serial.STOPBITS_ONE,
                bytesize=serial.EIGHTBITS,
                timeout=0
        )
        ser.close()
        ser.open()
        data = ""

	if sys.argv[2] == "1" :
		ser.write('\x7E\x32\x35\x30\x31\x34\x36\x34\x34\x45\x30\x30\x32\x30\x31\x46\x44\x32\x45\x0D')
	elif sys.argv[2] == "2" :
		ser.write('\x7E\x32\x35\x30\x32\x34\x36\x34\x34\x45\x30\x30\x32\x30\x32\x46\x44\x32\x43\x0D')
	elif sys.argv[2] == "3" :
		ser.write('\x7E\x32\x35\x30\x33\x34\x36\x34\x34\x45\x30\x30\x32\x30\x33\x46\x44\x32\x41\x0D')
	elif sys.argv[2] == "4" :
		ser.write('\x7E\x32\x35\x30\x34\x34\x36\x34\x34\x45\x30\x30\x32\x30\x34\x46\x44\x32\x38\x0D')
	elif sys.argv[2] == "5" :
		ser.write('\x7E\x32\x35\x30\x35\x34\x36\x34\x34\x45\x30\x30\x32\x30\x35\x46\x44\x32\x36\x0D')
	elif sys.argv[2] == "6" :
		ser.write('\x7E\x32\x35\x30\x36\x34\x36\x34\x34\x45\x30\x30\x32\x30\x36\x46\x44\x32\x34\x0D')
	elif sys.argv[2] == "7" :
		ser.write('\x7E\x32\x35\x30\x37\x34\x36\x34\x34\x45\x30\x30\x32\x30\x37\x46\x44\x32\x32\x0D')
	elif sys.argv[2] == "8" :
		ser.write('\x7E\x32\x35\x30\x38\x34\x36\x34\x34\x45\x30\x30\x32\x30\x38\x46\x44\x32\x30\x0D')
	elif sys.argv[2] == "9" :
		ser.write('\x7E\x32\x35\x30\x39\x34\x36\x34\x34\x45\x30\x30\x32\x30\x39\x46\x44\x31\x45\x0D')
	elif sys.argv[2] == "10" :
		ser.write('\x7E\x32\x35\x30\x41\x34\x36\x34\x34\x45\x30\x30\x32\x30\x41\x46\x44\x30\x45\x0D')
	elif sys.argv[2] == "11" :
		ser.write('\x7E\x32\x35\x30\x42\x34\x36\x34\x34\x45\x30\x30\x32\x30\x42\x46\x44\x30\x43\x0D')
	elif sys.argv[2] == "12" :
		ser.write('\x7E\x32\x35\x30\x43\x34\x36\x34\x34\x45\x30\x30\x32\x30\x43\x46\x44\x30\x41\x0D')
	elif sys.argv[2] == "13" :
		ser.write('\x7E\x32\x35\x30\x44\x34\x36\x34\x34\x45\x30\x30\x32\x30\x44\x46\x44\x30\x38\x0D')
	elif sys.argv[2] == "14" :
		ser.write('\x7E\x32\x35\x30\x45\x34\x36\x34\x34\x45\x30\x30\x32\x30\x45\x46\x44\x30\x36\x0D')
	elif sys.argv[2] == "15" :
		ser.write('\x7E\x32\x35\x30\x46\x34\x36\x34\x34\x45\x30\x30\x32\x30\x46\x46\x44\x30\x34\x0D')
	else :
        	print "0"
        	#print "~-2-5-0-2-4-6-0-0-2-0-4-A-0-0-0-2-0-F-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-6-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-2-0-0-0-4-8-0-0-4-0-0-0-0-0-0-0-0-0-4-0-0-E-F-8-2-";
		ser.close()
		exit()
	''' OLD DATA
	sr = ser.read(2048)
	tag='-'.join(x for x in sr)
	print tag
	ser.close()
	'''
	
	while True:
                raw = str(ser.read(1))
                data+= raw
                if raw == "\r":
                        tag='-'.join(x for x in data)
                        print tag
                        ser.close()
                        break

else:
	print "0"
	#print "~-2-5-0-2-4-6-0-0-2-0-4-A-0-0-0-2-0-F-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-6-0-0-0-0-0-0-0-0-0-0-0-0-0-0-0-2-0-0-0-4-8-0-0-4-0-0-0-0-0-0-0-0-0-4-0-0-E-F-8-2-";
