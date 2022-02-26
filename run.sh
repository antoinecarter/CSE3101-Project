#!/usr/bin/bash
cp inc/view /opt/lampp/htdocs/
sudo killall apache2
cd /opt/lampp/
sudo ./xampp start
firefox -P "Google" https://localhost/view/
