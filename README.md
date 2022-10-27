# steps to install project 

- clone project from github 
- cd into your project
- composer install
- cp .env.example .env 
- Generate an app encryption key php artisan key:generate
- Create an empty database for our application and set it on env file
- php artisan migrate
- php artisan db:seed
- php artisan serve 
- at final login with (`owner@project.com`, `password`)
