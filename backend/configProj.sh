docker-compose up -d --build --force-recreate
docker exec -i api_alunos cp -r .env.example .env
docker exec -i api_alunos chmod 777 -R storage
docker exec -i api_alunos composer install
docker exec -i api_alunos php artisan make:session-table
docker exec -i api_alunos chmod 777 -R database/database.sqlite
docker exec -i api_alunos php artisan migrate
docker exec -i api_alunos php artisan key:generate