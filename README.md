# API M2 - BELCHIOR
API software for M2 Digital.

## Technologies
The following technologies are being used to make this project work.

- *Laravel 9.x* - One of the most popular PHP Frameworks.
- *MySQL (or MariaDB)* - MySQL is an open-source relational database management system. Its name is a combination of "My", the name of co-founder Michael Widenius's daughter, and "SQL", the abbreviation for Structured Query Language.

## Features
The features are:
- City (CRUD)
- City group (CRUD)
- Campaigns (CRUD)
- Products (CRUD)
- Discounts (CRUD)

## Project Setup
This project is basically a Laravel project. To run it you just need to follow the requirements of the framework. Is strongly recommended to run this project using Docker. You can install Docker following the instructions on the link [get Docker](https://docs.docker.com/engine/install/).

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
php artisan test # run feature tests
```

#### Stop the application
To stop the application you can execute the following command

```bash
docker-compose down -v
```

## End-points

### City:

For get city:
```json
Method: GET
URL: /api/product/all
```


For input new city:
```json
Method: POST
URL: /api/product/insert
Data body:
- 'name' => 'required | min:3',
- 'group_id' => 'nullable | numeric'
```


For update city:
- NOTE: At least 1 of the fields below must be completed
```json
Method: POST
URL: /api/product/update/ID_CITY
Data body:
- 'name' => 'nullable | min:3',
- 'group_id' => 'nullable | numeric'
```


For delete city:
```json
Method: GET
URL: /api/product/delete/ID_CITY
```




### City group:

For get city group:
```json
Method: GET
URL: /api/groups/all
```


For input new city group:
```json
Method: POST
URL: /api/groups/insert
Data body:
- 'name' => 'required | min:3',
- 'campaign_id' => 'nullable | numeric'
```


For update city group:
- NOTE: At least 1 of the fields below must be completed
```json
Method: POST
URL: /api/groups/update/ID_GROUP
Data body:
- 'name' => 'nullable | min:3',
- 'campaign_id' => 'nullable | numeric'
```


For delete city group:
```json
Method: GET
URL: /api/groups/delete/ID_GROUP
```




### Campaign:

For get campaign:
```json
Method: GET
URL: /api/campaigns/all
```


For input new campaign:
- NOTE: status 1 for active and 2 for inactive, default by 1
```json
Method: POST
URL: /api/campaigns/insert
Data body:
- 'name' => 'required | min:3',
- 'status' => 'nullable | numeric'
```


For update campaign:
- NOTE: At least 1 of the fields below must be completed
```json
Method: POST
URL: /api/campaigns/update/ID_CAMPAIGN
Data body:
- 'name' => 'nullable | min:3',
- 'status' => 'nullable | numeric'
```


For delete campaign:
```json
Method: GET
URL: /api/campaigns/delete/ID_CAMPAIGN
```



### Product:

For get product:
```json
Method: GET
URL: /api/product/all
```


For input new product:
- NOTE: Price used USD format (0.00)
```json
Method: POST
URL: /api/product/insert
Data body:
- 'name' => 'required | min:3',
- 'price' => 'required | numeric'
```


For update product:
- NOTE: At least 1 of the fields below must be completed
```json
Method: POST
URL: /api/product/update/ID_PRODUCT
Data body:
- 'name' => 'nullable | min:3',
- 'price' => 'nullable | numeric'
```


For delete product:
```json
Method: GET
URL: /api/product/delete/ID_PRODUCT
```


### Discount:

For get discount:
```json
Method: GET
URL: /api/discounts/all
```


For input new discount:
- NOTE: Discount used USD format (0.00)
```json
Method: POST
URL: /api/discounts/insert
Data body:
- 'campaign_id' => 'required | numeric'
- 'product_id' => 'required | numeric'
- 'discount' => 'required | numeric'
```


For update discount:
- NOTE: At least 1 of the fields below must be completed
```json
Method: POST
URL: /api/discounts/update/ID_DISCOUNT
Data body:
- 'campaign_id' => 'nullable | numeric'
- 'product_id' => 'nullable | numeric'
- 'discount' => 'nullable | numeric'
```


For delete discount:
```json
Method: GET
URL: /api/discounts/delete/ID_DISCOUNT
```