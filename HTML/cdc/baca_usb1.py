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
            self.ser = serial.Serial(sys.argv[1], 9600, timeout=3)
            self.SendCommand('ATZ\r')
            self.SendCommand('AT+CMGF=1\r')

        def SendCommand(self,command, getline=True):
            self.ser.write(command)
            data = ''
            if getline:
                data=self.ReadLine()
            return data 

        def ReadLine(self):
            data = self.ser.readline()
            print data
            return data 

        def GetAllSMS(self):
            self.ser.flushInput()
            self.ser.flushOutput()

            command = 'AT+CMGL="ALL"\r\n'#gets incoming sms that has not been read
            print self.SendCommand(command,getline=True)
            data = self.ser.readall()
	    isi = data.replace('AT+CMGL="ALL"','')
            isi = isi.replace("OK", "");
	    #trim isi sms
	    isi = isi.strip()
	    print isi
	    print "==========================================================="
	    pecah = isi.split('+CMGL: ')
	    pecah = pecah[1:]
    	    for word2 in pecah :
		word3 = word2.split(',')
		#word3 = word3[1:]
		if word3[1] == '"REC READ"' :
			print "Hapus :", word3[0]
			print "Sender :", word3[2]
			print "Isi :", word3[5].split('\r\n')[1]
			command2 = 'AT+CMGD='+word3[0]+'\r\n' #delete sms
            		print self.SendCommand(command2,getline=True)
		else :
			print "SMS Baru :", word3[0]
			print "Sender :", word3[2]
			print "Isi :", word3[5].split('\r\n')[1]
			nmr = word3[2].replace('"','')
			if nmr[0] == "+" : 
				isi = word3[5].split('\r\n')[1]
				sqlstr = "insert into inbox (ReceivingDateTime,SenderNumber,TextDecoded,usbtype) values (NOW(),'"+nmr+"','"+isi+"','1')"
				cur.execute(sqlstr)			
				print sqlstr

h = HuaweiModem()
h.GetAllSMS()
