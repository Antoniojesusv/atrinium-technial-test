#!/bin/bash

cd symfony_project

echo "Hacemos la actualización del composer"
composer update
sleep 5

echo "Hacemos la instalación del composer"
composer install
sleep 5

echo "Hacemos la instalacion de npm"
npm install
sleep 5

echo "Levantamos los dockers"
cd ..
docker-compose up
sleep 5
