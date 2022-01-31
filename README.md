# Region Photo

## Configuration

#### Before installation create .env file. You can copy it from .env.example file

## Adding user

#### There are two types of user credentials in the .env file. One is for Super Administrator and one is for Basic User. Add user email and password before installation.

## Installation

### First install dependencies by runnging ```composer install```
### To generate app key run ```php artisan key:generate```
### Then migrate database by runnging ```php artisan migrate --seed```
### Run ```php artisan storage:link``` to create symlinks

