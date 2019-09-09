import serial, subprocess, time, signal, sys

# ambil json
json = subprocess.Popen(['php', '/home/pi/code/json.php'], stdout=subprocess.PIPE)
json = json.stdout.readline().strip()
raw = json.split("|")
id_json = raw[0] 
json = raw[1]
len_json = len(json)
if len_json < 10 :
	sys.exit()
# check pi version dan ambil address serial gsm
sr = subprocess.Popen(['bash', '/home/pi/pi_version.sh'], stdout=subprocess.PIPE)
sr = sr.stdout.readline().strip()

# init serial
ser = serial.Serial(port=sr, baudrate=9600)

# function send AT Command
def at_send(command,expected):
	if len(command) > 100 :
		print_cmd = "JSON Data"
	else:
		print_cmd = command
	print "\n\nSending Command : ["+print_cmd.strip()+"]"
	ser.write(command.encode())
	serstr=""
	num = 0
	while True:
		num = num + 1
		response = ser.readline()
        	serstr = serstr + response
        	if expected in response or "ERROR" in response :
			print "Expected Response Received : "+response.strip()
			break
		else:
			print "Still Waiting For Response : ["+expected+"] .... ("+str(num)+")"
	return serstr

# function set timeout of running time
def signal_handler(signum, frame):
	raise Exception("Timed out!")

# main function
def main_f():
	at_send('AT+SAPBR=3,1,"Contype","GPRS"\r',"OK")
	at_send('AT+SAPBR=3,1,"APN","internet"\r',"OK")
	at_send('AT+SAPBR=1,1\r',"OK")
	at_send('AT+SAPBR=2,1\r',"OK")
	at_send('AT+HTTPINIT\r',"OK")
	at_send('AT+HTTPPARA="CID",1\r',"OK")
	at_send('AT+HTTPPARA="URL","http://203.77.234.2/nipress/poll.php"\r',"OK")
	at_send('AT+HTTPPARA="CONTENT","application/json"\r',"OK")
	at_send('AT+HTTPDATA='+str(len_json)+',90000\r',"DOWNLOAD")
	at_send(json,"OK")

	# read sent response
	sent = at_send('AT+HTTPACTION=1\r',"HTTPACTION:")
	if "1,200" in sent :
		print "---JSON SENT---"
		query_upd = "update log set synced = '1' where id in ("+id_json+")"
		delete_data = subprocess.Popen(['bash', '/home/pi/code/mysql', query_upd], stdout=subprocess.PIPE)

	#at_send('AT+HTTPREAD\r',"OK")
	at_send('AT+HTTPTERM\r',"OK")
	at_send('AT+SAPBR=0,1\r',"OK")
	ser.close()
	sys.exit()


# main program
signal.signal(signal.SIGALRM, signal_handler)
signal.alarm(180)   # 3 minutes
try:
	main_f()
except Exception, msg:
	print "Timed out!"
	at_send('AT+HTTPTERM\r',"OK")
        at_send('AT+SAPBR=0,1\r',"OK")
        ser.close()
	sys.exit()
