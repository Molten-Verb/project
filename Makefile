start:
	docker-compose build
	docker-compose up -d
	docker exec -it project_app composer install
	docker exec -it project_app php artisan migrate
	docker exec -it project_app php artisan db:seed PermissionsSeeder
	docker exec -it project_app php artisan db:seed RacerSeeder
