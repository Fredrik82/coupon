# coupon
A boilerplate for creating a microservice that creates and distributes discount codes.

## Prerequisites
* [Docker](https://www.docker.com/get-started)
* [Curl](https://curl.se/download.html) or [Postman](https://www.postman.com/downloads/)

### Setup
```bash
$ docker-compose up --build -d
$ docker-compose exec php sh
$ composer install
```

### Usage

#### Create campaign
```bash
$ curl --location --request POST 'http://localhost:8080/topic/foo/123' \
--header 'Content-Type: application/json' \
--header 'Cache-Control: no-cache' \
--form 'campaign_name="foo"' \
--form 'expire_date="202201202"'
```
Version 1

![img.png](docs/img/1_create_campagin.png)

Version 2
![img.png](docs/img/1_create_campaginv2.png)

#### Fetch discount code
```bash
$ curl --location --request GET 'http://localhost:8080/topic/foo' \
--header 'Content-Type: application/json' \
--header 'Cache-Control: no-cache'
```

![img.png](docs/img/2_retrieve_coupon.png)