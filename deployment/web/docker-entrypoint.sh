#!/bin/bash
a2enmod rewrite;
apt-get install php7.0-xml;
service apache2 start;
tail -f /dev/null;