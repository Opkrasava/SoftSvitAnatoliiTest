init:
	docker-compose run --rm app composer create-project symfony/skeleton .

up:
	docker-compose up --build

bash:
	docker-compose exec app bash

migrate:
	docker-compose exec app php bin/console doctrine:migrations:migrate

down:
	docker-compose down

