# Laravel + Vuejs Dockerized

- This Project is built with **Docker**, **Laravel** To Create Very Simple News site.

## Features

- CRUD functions
- Feature Test wiht Factory using Faker.
- Event on New News Creation
- Cronjob which deletes news older then 14 days.

## Installation:

- ```docker-compose up -d --build```
- ```docker-compose run --rm composer require laravel/ui --dev```
- ```docker-compose run --rm artisan ui vue --auth```  
 **OR** 
- ```docker-compose run --rm artisan ui bootstrap --auth``` 
- ```docker-compose run --rm composer install```
- ```docker-compose run --rm npm install```
- Now create .env file and replace DB_CONNECTION with ```DB_HOST=sqlite & REDIS_HOST=redis```  
 **OR** 
- Just Rename /src/env.sample as .env file (If you just want to explore project)
- ```docker-compose run --rm artisan migrate:install ```
- ```docker-compose run --rm artisan migrate ```


## Run Tests

- ```docker-compose run --rm artisan test```


## Useage:

- Development:
    - ```docker-compose run --rm npm run watch-poll``` 
    - OR 
    - ```docker-compose run --rm npm run dev```
- Production:
    - ```docker-compose run --rm npm run prod```

## Refences:

- https://laravel.com/docs/8.x/http-tests
- https://laravel.com/docs/8.x/database-testing
- https://laravel.com/docs/8.x/events

## Other Commands:

- ```docker-compose run --rm artisan make:controller TestController```
- ```docker-compose run --rm artisan make:request TestNewsPost```
- ```docker-compose run --rm artisan make:factory TestFactory --model=Test```
- ```docker-compose run --rm artisan make:test NewsTest --feature```
- ```docker-compose run --rm artisan event:generate```
- ```docker-compose run --rm artisan make:command TestCron --command=test:cron```