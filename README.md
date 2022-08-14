

## Installation
Clone the project from github and run below command on root directory to copy docker-compose.yml file

```shell
cp docker-compose.yml.example docker-compose.yml
```

> NB: All docker settings are isolated.


Now goto the `app` directory and copy .env.example into .env and sibling .env in docker directory.

```shell
cp .env.example .env
```

## Run Docker
To run the project you have to run this command from `car-api-test` project directory root

```shell
docker-compose up -d --build
```
Docker runs all the services in the background upon successful execution of above command.
Now install app project dependencies running following commands step by step.

```shell
docker-compose exec app composer install
```

To migrate database changes run the command

```shell
docker-compose exec app php artisan migrate

```
> NB: before starting any request, please give permission at storage folder.


To show all the running process run the command bellow

```shell
docker-compose ps
```

To stop all the services run the command

```shell
docker-compose down
```
