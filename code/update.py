import requests
import os
import shutil
import sys
import hashlib
from zipfile import ZipFile

def md5Checksum(filePath):
    with open(filePath, 'rb') as fh:
        m = hashlib.md5()
        while True:
            data = fh.read(8192)
            if not data:
                break
            m.update(data)
        return m.hexdigest()

def downloadFile(url):
    path = url.split('/')[-1].split('?')[0]
    r = requests.get(url, stream=True)
    if r.status_code == 200:
        with open("/home/pi/"+path, 'wb') as f:
            for chunk in r:
                f.write(chunk)


#urlFirmware = "http://bg.dev.miota.io/download/code.zip"
#urlMd5 = "http://bg.dev.miota.io/download/md5.txt"
#urlVersion = "http://bg.dev.miota.io/download/version2"
urlFirmware = str(sys.argv[1])
urlMd5 = str(sys.argv[2])
urlVersion = str(sys.argv[3])
fileFirmwareWeb = urlFirmware.split('/')[-1].split('.')[0]
fileVersionWeb = urlVersion.split('/')[-1].split('.')[0]
version = open("/home/pi/version.txt","r").read().strip()

if not (os.path.exists("/home/pi/code")):
    downloadFile(urlMd5)
    print("Download Md5 Success")
    md5 = open("/home/pi/md5.txt","r").read().strip()
    downloadFile(urlFirmware)
    print("Download Firmware Success")
    print(md5Checksum("/home/pi/"+fileFirmwareWeb+".zip"))
    if md5.strip() == md5Checksum("/home/pi/"+fileFirmwareWeb+".zip"):
        print("Data Not Corrupt")
        with ZipFile("/home/pi/"+fileFirmwareWeb+".zip", 'r') as zipObj:
            zipObj.extractall("/home/pi/")
        print("Extract Done")
        version = open("/home/pi/version.txt","w")
        version.write(fileVersionWeb)
        print("Version Update")
        print("Delete Zip")
        os.remove("/home/pi/"+fileFirmwareWeb+".zip")
    else:
        print("Data Corrupt")
        print("Delete Zip")
        os.remove("/home/pi/"+fileFirmwareWeb+".zip")
    os.system("sudo reboot")

elif fileVersionWeb != version:
    downloadFile(urlMd5)
    print("Download Md5 Success")
    md5 = open("/home/pi/md5.txt","r").read().strip()
    if os.path.exists("/home/pi/OLD"):
        print("Folder OLD found ")
    else:
        os.makedirs("/home/pi/OLD")
    if os.path.exists("/home/pi/OLD/"+fileFirmwareWeb):
        print("File Found")
        shutil.rmtree("/home/pi/OLD/"+fileFirmwareWeb)
    shutil.copytree("/home/pi/"+fileFirmwareWeb,"/home/pi/OLD/"+fileFirmwareWeb)
    shutil.rmtree("/home/pi/"+fileFirmwareWeb)
    downloadFile(urlFirmware)
    print("Download Firmware Success")
    print(md5Checksum("/home/pi/"+fileFirmwareWeb+".zip"))
    if md5.strip() == md5Checksum("/home/pi/"+fileFirmwareWeb+".zip"):
        print("data not Corrupt")
        # todo extract file
        with ZipFile("/home/pi/"+fileFirmwareWeb+".zip", 'r') as zipObj:
            zipObj.extractall("/home/pi/")
        version = open("/home/pi/version.txt","w")
        version.write(fileVersionWeb)
        print("Version Update")
        print("Delete Zip")
        os.remove("/home/pi/"+fileFirmwareWeb+".zip")
    else:
        #shutil.move("/home/bobby/Project/Miota/OLD/"+fileFirmwareWeb,"/home/bobby/Project/Miota/"+fileFirmwareWeb
        shutil.move("/home/pi/OLD/"+fileFirmwareWeb,"/home/pi/"+fileFirmwareWeb)
        print("Delete Zip")
        os.remove("/home/pi/"+fileFirmwareWeb+".zip")
        print("Old Version")
    os.system("sudo reboot")
else :
    print("Version Up to date")
