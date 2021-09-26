# Simple E-Comerce

Simple E-Comerce build use Laravel 5.6 require php version 5.6 or 7.4

## Setup Project on Local

### 1. Clone this project & move to the directory project.

#### Install all depencies required:

```bash
composer install
```
```bash
composer dump-autoload
```
#### Create environtment(.env) file:
```bash
cp .env.example .env
php artisan key:generate
```
#### edit the parts listed below:
```environment
APP_NAME=SimpleEcomerce
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost:8000
MY_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_username
DB_PASSWORD=your_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=

RAJAONGKIR_APIKEY=your_key
RAJAONGKIR_URI=https://pro.rajaongkir.com/
gmap_apikey=your_key
```
#### Migrate & seed database schema:
```bash
php artisan migrate
php artisan db:seed
```

#### Publish vendor & check url route of application:
```bash
php artisan vendor:publish
php artisan route:list
```

#### if the route appears, run the application:
```bash
php artisan serve
```
#### Go to web appilcation:
[http://localhost:8000](http://localhost:8000)


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[Apache License 2.0](https://github.com/ranggadarmajati/simple-ecomerce/blob/main/LICENSE)
