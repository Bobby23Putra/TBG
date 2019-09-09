#./modpoll -m rtu -b 9600 -d 8 -s 1 -p none -a 1 -r 3035 -c 1 -t 4:float /dev/ttyUSB0
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

#count= the number of registers to read
#unit= the slave unit this request is targeting
#address= the starting address to read from

#client = ModbusClient('localhost', port=5020)
#client = ModbusClient(method='ascii', port='/dev/pts/2', timeout=1)
if len(sys.argv) < 4 :
	print "Argument : [slave addr] [register addr] [length]"
	exit()

slave = int(sys.argv[1])
reg = int(sys.argv[2])
ln = int(sys.argv[3])

client = ModbusClient(method='rtu', port='/dev/ttyS3', timeout=1, stopbits = 1, bytesize = 8, parity = 'E', baudrate = 9600)
try:
	if client.connect() :
		#read value
		#Starting add, num of reg to read, slave unit.
		#for i in range(0, 13):
		result = client.read_holding_registers(reg,ln,unit=slave)
		result = client.read_holding_registers(reg,ln,unit=slave)
		result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(reg,ln,unit=slave)
		#result = client.read_holding_registers(3109,2,unit=1)

		# decode manually
		#raw = struct.pack('>HH', result.getRegister(0), result.getRegister(1))
		#value = struct.unpack('>f', raw)[0]
		#print result.getRegister(0)
		#print result.getRegister(1)
                #print ln
		if ln == 1 :
			print result.getRegister(0)
		else :
		#print round(value,2)

		# list of decode function :
		#decoded = OrderedDict([
		#        ('string', decoder.decode_string(8)),
		#        ('bits', decoder.decode_bits()),
		#        ('8int', decoder.decode_8bit_int()),
		#        ('8uint', decoder.decode_8bit_uint()),
		#        ('16int', decoder.decode_16bit_int()),
		#        ('16uint', decoder.decode_16bit_uint()),
		#        ('32int', decoder.decode_32bit_int()),
		#        ('32uint', decoder.decode_32bit_uint()),
		#        ('32float', decoder.decode_32bit_float()),
		#        ('32float2', decoder.decode_32bit_float()),
		#        ('64int', decoder.decode_64bit_int()),
		#        ('64uint', decoder.decode_64bit_uint()),
		#        ('ignore', decoder.skip_bytes(8)),
		#        ('64float', decoder.decode_64bit_float()),
		#        ('64float2', decoder.decode_64bit_float()),
		#    ])

		#[4, 3, 2, 1] - byteorder = Endian.Big, wordorder = Endian.Big
		#[3, 4, 1, 2] - byteorder = Endian.Little, wordorder = Endian.Big
		#[1, 2, 3, 4] - byteorder = Endian.Little, wordorder = Endian.Little


		#decode using pymodbus func
			#print result.registers
			dec = BinaryPayloadDecoder.fromRegisters(result.registers, byteorder=Endian.Big, wordorder=Endian.Big)
			print round(dec.decode_32bit_float(),2)
			#print dec.decode_bits_bits()
		#-----------------#write value
		#rq = client.write_coil(10001, 1, unit=0x0a)
		#rq = client.write_register(40001, 2, unit=0x0a)

		client.close()
	else:
		print("Connection Error")
except:
	print("Error")
