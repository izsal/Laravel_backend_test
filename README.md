Installation
 # Clone the project
 git clone https://github.com/izsal/Laravel_backend_test.git

 # Enter the project directory
 cd project

 # Copy env file and add your own database and mail credentials
 cp .env.example .env

 # Install dependency
 composer install

 # Generate app key
 php artisan key:generate
 
 # Serving application
 php artisan serve
