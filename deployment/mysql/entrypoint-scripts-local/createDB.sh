#!/bin/bash
mysql --user=root --password=admin --execute 'CREATE DATABASE db_base_symfony;'
# mysql -uroot -padmin db_cibest < /var/www/html/cibest/database/db_base_symfony.sql
# mysqldump -uroot -pm7GjTag9xY40oVDA db_cibest > /var/www/html/cibest/database/db_cibest2.sql