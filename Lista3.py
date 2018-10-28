import selenium.webdriver
import subprocess
driver = selenium.webdriver.Chrome("C:\chromedriver.exe")
driver.get("http://www.mikolaj.ovh")
driver.delete_all_cookies()
p = subprocess.Popen(['C:\\Program Files\\Wireshark\\tshark', '-i', '1', '-Y', 'http.request', '-a', 'duration:10', '-T', 'fields', '-e', 'http.cookie', 'host', 'mikolaj.ovh'], stdout=subprocess.PIPE)



while True:
	line = p.stdout.readline().rstrip().decode("utf-8")
	if line:
		print ("test:", line)
		if(len(line)>1):
			while(True):
				i = line.find('=')
				if(i == -1):
					break
				j = line.find(';')
				if(j == -1):
					j = len(line)
				k = line[:i]
				v = line[i+1:j]
				line = line[j+2:]
				print(k)
				print(v)
				driver.add_cookie({'name':k, 'value':v, 'path':'/'})	
			break

for cookie in driver.get_cookies():
    print ((cookie['name'], cookie['value']))

