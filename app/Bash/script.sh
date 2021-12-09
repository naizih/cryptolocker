#!/bin/bash


if curl -s --head  --request GET http://192.168.56.200:8000 | grep "200 OK" > /dev/null; then 
   echo "cryptolocker is UP"
   curl -X POST http://192.168.56.200:8000/bash -H "Content-Type: application/json" -d '{"login":"my_login","password":"my_password"}'

else
   echo "cryptolocker is DOWN"
fi
