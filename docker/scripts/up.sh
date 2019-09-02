#!/bin/bash

cd symfony_project

# echo "Entramos en el docker"
# docker exec -it php_symfony_project /bin/sh
# sleep 3

echo "Creamos nuestra base de datos"
docker exec -it php_symfony_project php bin/console doctrine:database:create

echo "Creamos las migraciones necesarias"
docker exec -it php_symfony_project php bin/console make:migration
sleep 3

echo "Ejecutamos las migraciones"
docker exec -it php_symfony_project php bin/console doctrine:migrations:migrate
sleep 3

echo "Rellenamos la base de datos"
docker exec -it php_symfony_project php bin/console doctrine:fixtures:load
