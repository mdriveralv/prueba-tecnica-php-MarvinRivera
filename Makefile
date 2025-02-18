build:
	docker-compose build

up:
	docker compose up

down:
	docker compose down

test:
	./vendor/bin/phpunit

create-database:
	php bin/doctrine.php orm:schema-tool:update --force