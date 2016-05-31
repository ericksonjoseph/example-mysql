#!/bin/bash
if [[ -z $1 ]]; then
    echo "Please pass an arg to send to MySQL"
    exit 1
fi

mip=$(docker-machine ip default)

# supress the insecure password warning
echo $1 | mysql -h $mip -P 3306 -uroot -proot test > /dev/null 2>&1
