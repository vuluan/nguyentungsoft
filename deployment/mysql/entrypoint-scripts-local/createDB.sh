#!/bin/bash
mysql --user=root --password=admin --execute 'CREATE DATABASE db_base_symfony;';
mysql -uroot -padmin db_base_symfony < /var/www/html/base-symfony/database/db_base_symfony.sql
# mysqldump -uroot -padmin db_base_symfony > /var/www/html/base-symfony/database/db_base_symfony.sql