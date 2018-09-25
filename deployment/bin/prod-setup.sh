#!/bin/bash
BASE_DIR=$(cd $(dirname $0); cd ..; pwd)

# Running Information
echo "-- Running script with「BASE_DIR」is: ${BASE_DIR} --";

cd ${BASE_DIR};

# Docker up
docker-compose -f docker-compose-prod.yml up --build -d;

# Showing information
docker-compose ps
