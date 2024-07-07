## Requisitos

* PHP 8.2 ou superior 
* MySQL 8 ou superior 
* Composer

## Como rodar o projeto baixado 

Duplicar o arquivo ".env.example" e renomear para ".env".<br>
Alterar no arquivo .env as credenciais do banco de dados.<br>

Instalar as dependências do PHP 
```
composer install
```

Gerar a chave no arquivo .env 
```
php artisan key:generate
```

Executar as migrations
```
php artisan migration
```

Executar as seeds
```
php artisan db:seed
```

Para acessar a API, é recomendado utilizar o Insomnia para simular requisições à API.
```
http://127.0.0.1:8000/api/users
```

## Sequencia para criar o projeto

Criar o projeto
```
composer create-project laravel/laravel .
```

Alterar no arquivo .env as credenciais do banco de dados <br>

Criar o arquivo de rotas para API
```
php artisan install:api
```
 