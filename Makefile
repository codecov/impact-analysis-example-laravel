
up:
	echo "COMMIT_SHA=`git rev-parse --verify HEAD`" > .env.docker-compose
	docker-compose --env-file ./.env.docker-compose up -d

shell:
	docker exec -ti laravel-rti-example_php-fpm_1 bash