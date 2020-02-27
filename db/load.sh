#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U selfemplo -d selfemplo < $BASE_DIR/selfemplo.sql
fi
psql -h localhost -U selfemplo -d selfemplo_test < $BASE_DIR/selfemplo.sql
