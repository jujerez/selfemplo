#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE selfemplo_test;"
    psql -U postgres -c "CREATE USER selfemplo PASSWORD 'selfemplo' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists selfemplo
    sudo -u postgres dropdb --if-exists selfemplo_test
    sudo -u postgres dropuser --if-exists selfemplo
    sudo -u postgres psql -c "CREATE USER selfemplo PASSWORD 'selfemplo' SUPERUSER;"
    sudo -u postgres createdb -O selfemplo selfemplo
    sudo -u postgres psql -d selfemplo -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O selfemplo selfemplo_test
    sudo -u postgres psql -d selfemplo_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:selfemplo:selfemplo"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
