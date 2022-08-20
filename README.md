# HRTools

## Technologies

* PHP 8.1
* [Laravel 9](https://laravel.com)
* [Docker](https://www.docker.com/)

## Install

## Set your .env vars:

cp .env.example .env

## Start application docker containers:

docker-compose up -d


## Install composer dependencies and generate app key:

docker exec -it hrtools-app composer install

docker exec -it hrtools-app php artisan key:generate


## Database migrations install (set proper .env vars)

docker exec -it hrtools-app php artisan migrate



## Application server should be ready on `http://localhost:<APP_PORT>`


## FAQ

* `Illuminate\Database\QueryException  : SQLSTATE[HY000] [2002] Connection refused`
    * The application can not connect to the database. Probably, `DB_HOST` environment variable is not set correctly. If you are using `docker-compose` configuration, the database host will match the database container name from `docker-compose.yml` (`mysql` in this case).
* `SQLSTATE[HY000] [1045] Access denied for user 'XXXX'@'thread-app.backend_default' (using password: YES)`
    * The application can not connect to the database due to incorrect username and password. Most likely, `DB_USERNAME` or/and `DB_PASSWORD` environment variables are set incorrectly. If you are using `docker-compose` configuration, the database username and password will match the initial values `MYSQL_USER` and `MYSQL_PASSWORD` of `docker-compose.yml` (`user` and `secret` in this case). Keep in mind that these credentials are set on the first time database container running, and changing these values will not take effect unless the database data folder will be deleted and the database container will be recreated.
* `Composer could not find a composer.json file in /var/www/app. To initialize a project, please create a composer.json file as described in the https://getcomposer.org/ "Getting Started" section`
    * Most likely you are on Windows and shared folders are not configured correctly. Please, follow the instructions from [this article](https://rominirani.com/docker-on-windows-mounting-host-directories-d96f3f056a2c) in case you have `Docker for Windows`, or [this article](https://github.com/docker/toolbox/issues/796#issuecomment-582267767) in case you have `Docker Toolbox`. The easiest way is to put the project folder to the `C:\Users\` folder as it is shared by default.
* `Access to XMLHttpRequest at 'http://XX.XX.XX.XX:7777/api/v1/auth/register' from origin 'http://127.0.0.1:8080' has been blocked by CORS policy: Response to preflight request doesn't pass access control check: No 'Access-Control-Allow-Origin' header is present on the requested resource.`
    * Most commonly, a critical error occurred on the backend, and CORS headers were not set, so the browser will not allow this request. You can send the same request via external tools (like [Postman](https://www.postman.com/)), and you will be able to see the error in the response there. In most cases, this error occurs when a database connection can not be established AND the framework can not write to the log file.
* `ERROR: for thread-webserver  Cannot start service webserver: OCI runtime create failed: container_linux.go:346:`
    * Probably, you have not configured shared folders for `Docker`. It is described in one of the previous answers.
