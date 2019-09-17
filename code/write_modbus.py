import pymodbus
import serial, struct, sys
from pymodbus.pdu import ModbusRequest
from pymodbus.client.sync import ModbusSerialClient as ModbusClient #initialize a serial RTU client instance
from pymodbus.transaction import ModbusRtuFramer
from pymodbus.constants import Endian
from pymodbus.payload import BinaryPayloadDecoder


#import logging
#logging.basicConfig()
#log = logging.getLogger()
#log.setLevel(logging.DEBUG)

if len(sys.argv) < 4 :
	print "Argument : [slave addr] [Register Add] [data]"
	exit()

slave = int(sys.argv[1])
reg = int(sys.argv[2])
data = int(sys.argv[3])

client = ModbusClient(method='rtu', port='/dev/ttyS2', timeout=1, stopbits = 1, bytesize = 8, parity = 'N', baudrate = 19200)
try :
	if client.connect():
		rq = client.write_registers(reg, data, unit=slave)
		if not rq.isError():
			print("Success")
		else:
			print("Error")
		#if "Error" not in rq:
		#	print("Success")
		#else:
		#	print("Error")
		client.close()
	else:
		print("Connection Error")
except:
	print("Error Connection")
