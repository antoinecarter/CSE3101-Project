#!/usr/bin/bash
cp -r inc/view /opt/lampp/htdocs/
cp -r css/ /opt/lampp/htdocs
sudo killall apache2
cd /opt/lampp/
sudo ./xampp start
firefox -P "Google" https://localhost/view/
