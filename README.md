# For Webscope code challenge
```
The requierment is following:
This coding challenge is defined broadly, 
with the aim of giving you the freedom to demonstrate your knowledge and skills as you see fit. 
You should aim to spend approximately 3 hours on your solution, 
excluding setting up your development environment and submitting the repository.
Your solution should be pushed to a public git repository, 
and should contain a README.md with instructions for setting up local development for the project.
Submit your solution by emailing us a link to the git repository.
Tools Required
•	Laravel
•	MySQL
•	Javascript
•	phpunit
Tools Recommended
•	Docker
•	Vue.js 2.0+
•	TypeScript
•	Jest
Task
Junior:
Create a basic todo list, that allows users to register, log in, 
and create tasks that are saved against their account.
Make sure to implement at least one unit test for the back end.
Extension 1 - Intermediate:
Create a burndown chart that displays the number of tasks that were not yet completed at each minute in the last hour. 
This chart should update dynamically.
```

# Assumption
**1. Add new task can only set task name, description, expect finish time**
```
```
**2. Function changing task status does not be contained in the solution**

# To install, Please following the steps following.

**Clone the repo**

```
https://github.com/FanZhangSX/wstodo.git
```

**Run composer install**
```
composer install
```
**Run npm install**
```
npm install
```
**Create .env**
```
cp .env.example .env
```
**Generate APP_KEY**
```
php artisan key:generate
```
**Setup Timezone in .env**
```
APP_TZ=Pacific/Auckland
```

**Configure MySQL connection details in .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database name}
DB_USERNAME={database user}
DB_PASSWORD={database password}
```
**Run database migrations and seeders**
```
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```
## Running the application

#### Comes with couple of default users
create User credentials are as follows
```
php artisan passport:install
```
## PHPUnit Test
To run the unit test, go to the project root and run
```
phpunit
```

