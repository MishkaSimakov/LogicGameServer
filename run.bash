#!/bin/bash

# read environment variables
source .env;

# MySQL server
UP=$(pgrep mysql | wc -l)

if [ "$UP" -ne 1 ];
then
        echo "MySQL is down."
	echo "Starting MySQL server..."
        sudo systemctl start mysqld
fi

echo "MySQL server work fine."

# MySQL database
RESULT=`mysql -u $DB_USERNAME -p$DB_PASSWORD --skip-column-names -e "SHOW DATABASES LIKE '$DB_DATABASE'"`

if [ "$RESULT" = "$DB_DATABASE" ];
then
	echo "Database ${DB_DATABASE} exist"
else
	echo "Database ${DB_DATABASE} does not exist"

	mysql -u $DB_USERNAME -p$DB_PASSWORD -e "CREATE DATABASE $DB_DATABASE"

	echo "Database $DB_DATABASE created."
fi

# Run server
HTTP_PORT=80
HTTPS_PORT=443

IP_ADDRESS="192.236.176.202"

php artisan serve --port=$HTTP_PORT --host=$IP_ADDRESS
