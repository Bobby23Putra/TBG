import MySQLdb
import serial
import time
import sys

db = MySQLdb.connect(host="localhost",user="root",passwd="root",db="cdc")
cur = db.cursor()

class HuaweiModem(object):
	def __init__(self):
            self.open()

	def open(self):
		modem=sys.argv[3]
		#modem="/dev/ttyUSB3"
		self.ser = serial.Serial(modem, 9600, timeout=3)
		self.SendCommand('ATZ\r')
		self.SendCommand('AT+CMGF=1\r')
		self.SendCommand('AT+CSCS="IRA"\r\n')

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

		print self.SendCommand(('AT+CMGS="%s"\r\n' % sys.argv[1]),getline=True)
		time.sleep(1)
		print self.SendCommand((sys.argv[2]),getline=True)
		print self.SendCommand((chr(26)),getline=True)
		time.sleep(2)
		data = self.ser.readall()
		#print "=====" + data + "===="
		pecah = data.split('\r\n')
		if "OK" in pecah :
			print "OK"
		else :
			print "Gagal"

h = HuaweiModem()
h.sendSMS()
