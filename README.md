# laravel_55

A simple blog app with laravel 5.5

##Requirements

1. PHP - Apache - MySQL server (XAMPP WAMP MAMP)

2. Composer

## Instructions 

1. Create .env file in project folder. Then copy .env.example content and paste it in .env.

3. Edit .env to your liking by adding your database and mysql server information

3. Create the database

4. Create cache directory in "Bootstrap" folder.

5. Open a cmd or a terminal go to project folder and run:

    composer update

    composer dump-auto

    php artisan key:generate
    
    php artisan migrate

6. Run the server by typing: php artisan serve