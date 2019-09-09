#!/usr/bin/env python

import serial
import time
import sys
import os
z
if os.path.exists(sys.argv[1]) :
        #ser = serial.Serial("/dev/ttyUSB0", 9600, timeout=1)
        ser = serial.Serial(
                port=sys.argv[1],
                baudrate=9600,
                parity=serial.PARITY_NONE,
                stopbits=serial.STOPBITS_ONE,
                bytesize=serial.EIGHTBITS,
                timeout=1
        )
        ser.close()
        ser.open()
        data = ""

#ser.write('\x7E\x32\x35\x30\x32\x34\x36\x39\x30\x30\x30\x30\x30\x46\x44\x41\x34\x0D') # number pack 
ser.write('\x7E\x32\x35\x30\x32\x34\x36\x34\x32\x45\x30\x30\x32\x30\x32\x46\x44\x32\x45\x0D') # battery 1
#ser.write('\x7E\x32\x35\x30\x38\x34\x36\x34\x32\x45\x30\x30\x32\x30\x32\x46\x44\x32\x38\x0D') # battery 2
#ser.write('\x7E\x32\x35\x30\x32\x34\x36\x34\x34\x45\x30\x30\x32\x30\x32\x46\x44\x32\x43\x0D') # alarm
sr = ser.read(1024)
#tag='-'.join(x.encode('hex') for x in sr)
tag='-'.join(x for x in sr)
print sr
print tag

