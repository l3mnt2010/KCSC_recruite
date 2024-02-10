#!/bin/bash

service cron start

echo "* * * * * root /clean.sh 2>&1" >> /etc/crontab

apache2-foreground