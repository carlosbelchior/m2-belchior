# API M2 - BELCHIOR
API software for M2 Digital.

## Technologies
The following technologies are being used to make this project work.

- *Laravel 9.x* - One of the most popular PHP Frameworks.
- *MySQL (or MariaDB)* - MySQL is an open-source relational database management system. Its name is a combination of "My", the name of co-founder Michael Widenius's daughter, and "SQL", the abbreviation for Structured Query Language.

## Features
_Coming..._

## Project Setup
This project is basically a Laravel project. To run it you just need to follow the requirements of the framework. Is strongly recommended to run this project using Docker when you're in the development phase. You can install Docker following the instructions on the link [get Docker](https://docs.docker.com/engine/install/).

The next sessions you'll give you some instructions on how to setup this application to run in a Docker container.

### Run it locally
The sections below describe how to set up the development environment.

#### Start up
To startup the application you can run the command shown below.

```bash
docker-compose up --build -d
```

Docker command to access the php service:

```bash
docker-compose exec php /bin/bash
```

It will start the applicaiton using some docker containers (nginx, mysql and PHP).

#### Settings files
Copy `.env.example` to `.env` and put your config variables like explained on [Laravel Config](https://laravel.com/docs/9.x/configuration).

NOTE: The default credentials for database are:
- host: mysql
- database: m2belchior
- user: root
- password: m2belchior

#### Install dependences

```bash
composer install 
```

#### Generate key

```bash
php artisan key:generate 
```

#### Run migrations
Enter in the php service and run migration as in a common Laravel project.

```bash
php artisan migrate # run migrations
```

#### Run Database seeders
```bash
php artisan db:seed # run seeders
```

#### Run Tests
Enter in the php service and run command above:

```bash
php artisan test
```

#### Stop the application
To stop the application you can execute the following command

```bash
docker-compose down -v
```

You can performe whatever command you want using `docker-compose`, the Makefile will just make it easier. To see other commands from make look at [Makefile](Makefile).
