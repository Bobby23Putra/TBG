import sys
import serial
import time
m = serial.Serial('/dev/ttyUSB1', 115200, timeout=5)
m.write('ATZ\r')
time.sleep(1)
m.write('AT+CSCS="IRA"\r\n')
m.write('AT+CMGF=1\r\n')
time.sleep(1)
m.write('AT+CMGS="%s"\r\n' % sys.argv[1])
time.sleep(1)
m.write(sys.argv[2])
m.write(chr(26))
time.sleep(2)
m.close()
