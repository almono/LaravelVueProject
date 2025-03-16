# Laravel API Template

A template API of Laravel project using MySQL, PHPMyAdmin, Nginx and Mailpit.

Additionally Swagger UI has been added for endpoint testing.

To build the project:
- Copy the repository
- In the main directory run ```composer install```
- In the main directory run ```docker compose build --no-cache``` and after it has finished building ```docker compose up -d```
- Inside the php container make sure you run the laravel migrations ```php artisan migrate``` ( ```php artisan migrate:install``` in case the previous did not work )
- After that generate APP token with ```php artisan key:generate``` and ```php artisan jwt:secret``` ( might require config clear with ```php artisan config:clear``` )

Your project should be available under these URLs:
- Laravel http://localhost:8000
- Swagger UI http://localhost:8000/api/documentation
- Mailpit http://localhost:8025
- PHPMyAdmin http://localhost:8080 ( user and password are both "laravel" )


## Features

- MySQL with PHPMyAdmin
- Nginx
- Mailpit
- Basic authentication ( with user login and registration )
- Swagger UI ( to update Swagger endpoints use ```php artisan l5-swagger:generate``` in the main directory )


## Environment Variables

To run this project, you will need to add/update the following environment variables to your .env file

Database:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_api_db
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

Mailpit:
```
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="laravel-template@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

JWT:
```
JWT_SECRET=XXX
```
