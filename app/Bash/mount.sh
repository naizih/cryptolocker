#!/bin/bash

sudo mount.cifs -o user=$1,pass=$2,vers=2.0 //$3/$4 $5

