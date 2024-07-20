
# Laravel Destinations Application

Project set up and start.

Main .env parameters exists in the file - 
```http
  .env.example
``` 

To start the project we need to follow this steps:

1) Install composer:
```http
  composer i
```

2) Create laravel sail enviroment for easy usage:
```http
  php artisan sail:install - after runing this command select only mysql
```

3) Start docker:
```http
  ./vendor/bin/sail up -d
```

4) Run migration and seed database:
```http
  ./vendor/bin/sail artisan migrate --seed
```
# API Documentation:
List of the existed destinations:
```http
  GET /api/destinations/list
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Nullable**. Retrieve list of destinations with same name |
| `lat` | `numeric` | **Nullable**. Retrieve list of destinations with same latitude |
| `lon` | `numeric` | **Nullable**. Retrieve list of destinations with same longitude |
| `offset` | `integer` | **Nullable**. Point where to start retrieving list. Min: 0, max: 15 |
| `limit` | `integer` | **Nullable**. Retrieve limit of entities. Min: 5, Max: 40 |


Get location in radius with selected destination:
```http
  GET /api/destinations/near-list
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Retrieve list of destinations that near to it location|
| `radius` | `numeric` | **Required**. Min: 0.01, Max:29999.99 - radius that will be used to search the destinations |
| `offset` | `integer` | **Nullable**. Point where to start retrieving list. Min: 0, max: 15 |
| `limit` | `integer` | **Nullable**. Retrieve limit of entities. Min: 5, Max: 40 |


##
# Main logic path
```http
  destinations api | routes/destinations.php

  DestinationController | Http/Controllers/Api/Destinations/DestinationController.php

  DestinationService | Http/Services/Api/Destinations/DestinationService.php
```
