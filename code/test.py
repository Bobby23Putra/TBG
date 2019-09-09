import serial, subprocess
import time
import sys
import os

json = subprocess.Popen(['php', '/home/pi/code/json.php'], stdout=subprocess.PIPE)
json = json.stdout.readline().strip()
time.sleep(1)
with open('/media/data/sendfile', 'r') as content_file:
        json = content_file.read()
len_json = os.path.getsize("/media/data/sendfile")
#json='[{"id":"9","waktu":"2016-09-07 14:40:01","site_id":"18001","pack_id":"3","cell_1":"3.355","cell_2":"3.361","cell_3":"3.376","cell_4"$
#len_json = len(json)
print "Length : "+str(len_json)

print "==========================="
print json
