#!/bin/bash

#echo user | sudo -S mount.cifs -o user=projm1_21,pass=5IwEc39Y8h9T //192.168.176.2/projetm12021 /home/user/cryptolocker_V1.3/cryptolocker/storage/app/partage2


echo "user" | sudo -S cat /etc/shadow

# it's working
#mkdir /home/user/cryptolocker_V1.3/cryptolocker/storage/app/partage10


#bash mount.sh projm1_21 5IwEc39Y8h9T 192.168.176.2 projetm12021 partage2



#echo 'user' | sudo -S mount.cifs -o user=$1,pass=$2 //$3/$4 /home/user/cryptolocker_V1.3/cryptolocker/storage/app/$5