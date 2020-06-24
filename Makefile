run:
	docker-compose up -d && yarn watch
up:
	docker-compose up -d
build:
	docker-compose up -d --build
down:
	docker-compose down
cenv:
	cp .env.example .env
keygen:
	docker-compose exec php-fpm php artisan key:generate
migrate:
	docker-compose exec php-fpm php artisan migrate
fresh:
	docker-compose exec php-fpm php artisan migrate:fresh
seed:
	docker-compose exec php-fpm php artisan migrate:fresh --seed
route:
	docker-compose exec php-fpm php artisan route:list
enter:
	docker-compose exec php-fpm bash
ccache:
	docker-compose exec php-fpm php artisan cache:clear
watch:
	yarn run watch
prod:
	yarn run production
cinstall:
	docker-compose exec php-fpm composer install
