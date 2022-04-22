# Task



## Getting started

1. docker-compose up -d
2. docker exec -it php-app-container composer install --no-interaction
3. docker exec -it php-app-container php ./bin/console doctrine:migrations:migrate --no-interaction