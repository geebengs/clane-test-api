# clane-test-api

CLANE TEST API

# Technology Used
- PHP 7.2
- MYSQL 5.7
- LARAVEL V5.8
- DOCKER
- PHP UNIT
- SWAGGER PHP FOR API DOCUMENTATION

# Setup Instruction
- CLONE or DOWNLOAD project
- cd on a command prompt to root of the project folder and RUN composer update
- Update .env file with your database information
- run composer dump-autoload
- run php artisan migrate
- run php artisan db:seed
- run docker-compose up --build to build docker image
- Application will run on http://localhost:8990

# API Documentation
- You will see the complete api documentation on http://localhost:8990/api/documentation

# Testing Instruction
- If you followed the instruction above step by step, a user would have been seeded to the database.
- Login using this endpoint: http://localhost:8990/api/v1/auth/login. User details, 
  email: clane.tester@gmail.com | Password: "password".
- Use access token returned to call authenticated routes by adding an Authorization header with Bearer "access token" as         value. (Using postman to test api is recommended)