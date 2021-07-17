init: docker-down docker-build docker-up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-build:
	docker-compose up --build -d

test:
	docker-compose exec php-cli vendor/bin/phpunit

queue:
	docker-compose exec php-cli php artisan queue:work

db-migrate:
	docker-compose exec php-cli php artisan migrate

db-migrate-seed:
	docker-compose exec php-cli php artisan migrate --seed

db-refresh:
	docker-compose exec php-cli php artisan migrate:refresh --seed
