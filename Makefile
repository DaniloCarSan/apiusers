
# Inicia a aplicação
# Permissão temporário nas pastas em caso de erro ao iniciar aplicação
start:
	cp .env.example .env
	sed -i 's/DB_HOST=localhost/DB_HOST=mysql/g' .env
	php artisan key:generate
	./vendor/bin/sail up -d
	docker exec -it apiusers-laravel.test-1 bash -c "chmod -R 777 ." 
start-build:
	cp .env.example .env
	sed -i 's/DB_HOST=localhost/DB_HOST=mysql/g' .env
	php artisan key:generate
	./vendor/bin/sail up -d --build
	docker exec -it apiusers-laravel.test-1 bash -c "chmod -R 777 ." 

# Faz a migração das tabelas do banco e insere dados falsos
# Cada vez que executado apaga o banco e cria tudo de novo
migrate:
	./vendor/bin/sail artisan migrate:refresh --seed

# Para a aplicação e outros serviços
stop: 
	./vendor/bin/sail stop

# Executa os teste da aplicação
test:
	./vendor/bin/sail test

# Gera a documentação da API
generate-openapi-docs:
	docker run --rm --user 1000 -v ./docs:/tmp/build -w /tmp/build -v ./openapi.yaml:/tmp/openapi.yaml node:14-slim npx -q redoc-cli bundle /tmp/openapi.yaml --output api-docs.html

# Entrar no container da aplicação
open-container-app:
	docker exec -it apiusers-laravel.test-1 bash