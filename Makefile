#!/bin/sh
GREEN='\033[0;32m'

cp .env.example .env

echo "\n${GREEN}Prepare settings...${NC}"

docker-compose run --rm --no-deps app composer install
docker-compose run --rm --no-deps app php artisan key:generate
docker-compose run --rm --no-deps app php artisan storage:link

echo "\n${GREEN}DONE"

echo "Now run"
docker-compose up -d
sleep 1
docker-compose exec app php artisan migrate --seed
docker-compose exec app php artisan serve --host=0.0.0.0

