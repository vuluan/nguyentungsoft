#!/bin/bash
BASE_DIR=$(cd $(dirname $0); cd ..; pwd)

# Running Information
echo "-- Running script with「BASE_DIR」is: ${BASE_DIR} --";

cd ${BASE_DIR};

# Docker up
COMPOSE_HTTP_TIMEOUT=200 docker-compose up --build -d;

# Showing information
docker-compose ps
