up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose stop
	docker-compose rm -vf
	docker-compose down -v
	docker-compose build
	docker-compose up -d
	docker-compose exec client-lib composer install --ignore-platform-reqs

test:
	docker-compose exec client-lib ./vendor/bin/phpunit tests/unit
