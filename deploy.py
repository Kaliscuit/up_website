import sys
import os
import time
while True:
    try:
        re = os.popen("git pull").read()
        a = re.split("\n")
        if a[0] != "Already up-to-date.":
            os.popen("/etc/init.d/php-fpm restart")
            print "Updated."
        else:
            print "Up to date."
    except:
        os.popen("git pull && /etc/init.d/php-fpm restart")
        print "Updated.."
    time.sleep(5) 
