import serial, subprocess
import time
import sys

# check pi version dan ambil address serial gsm
sr = subprocess.Popen(['bash', '/home/pi/pi_version.sh'], stdout=subprocess.PIPE)
sr = sr.stdout.readline().strip()

class HuaweiModem(object):
	def __init__(self):
            self.open()

	def open(self):
		self.ser = serial.Serial(sr, 9600, timeout=3)
		#self.SendCommand('ATZ\r')
		#self.SendCommand('AT+CUSD=2\r')
		#self.SendCommand('AT+CSCS="IRA"\r\n')

	def SendCommand(self,command, getline=True):
		self.ser.write(command)
		data = ''
		if getline:
			data=self.ReadLine()
		return data 

	def ReadLine(self):
		data = self.ser.readline()
		#print data
		#return data 

	def sendSMS(self):
		self.ser.flushInput()
		self.ser.flushOutput()

		print self.SendCommand(('AT+CUSD=1,"%s"\r\n' % sys.argv[1]),getline=True)
		time.sleep(1)
		#print self.SendCommand((sys.argv[2]),getline=True)
		#print self.SendCommand((chr(26)),getline=True)
		time.sleep(4)
		data = self.ser.readall()
		print "=====" + data + "===="
		#pecah = data.split('\r\n')
		#if "OK" in pecah :
		#	print "OK"
		#else :
		#	print "Gagal"

h = HuaweiModem()
h.sendSMS()
