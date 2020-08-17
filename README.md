# Demo Movie Project

This is a basic demo project of Api Rest with authorization by token.

In the project, apart from the classic Model-Controller, Resources are used with their respective links (HateOAS) for manage / navigation between the resources.

## Requirement

This application requires an installation of MySQL v5.7, preferably v8^

## Setup

1. Clone the repository

2. Create a new database/schema, user and password on MySql

3. Copy .env.example to .env

4. Config database params in .env file

5. Open a new terminal (if you don't have one previously open) 

6. Donwload and install all dependences

        Composer install
        
7. Create all tables in database and populate data with the seeders supported by factories 
    
        php artisan migrate-refresh --seed
        
8. Create the symbolic link

        php artisan storage:link

9. Install Laravel Passport

        php artisan passport:install
        
10. Create a new client in passport

        php artisan passport:client
        
    `for example set the id 1 to take the user with these id` 


## Authentication

It is necessary to have a client created to obtain the authorization token that will be used in the header of the Bearer requests

        POST
        http://demo-movie-project.test/oauth/token
        
With this params

        grant_type => client_credentials
        client_id => // id of passport client
        client_secret => // secret of passport client
        
In response , copy the token from "access_token", after set it in the request header


## URLs Available

| Method | URI |
|---|---|
| POST | oauth/token                             |
| GET  | api/v1/movie                            |
| POST | api/v1/movie                            |
| DELETE | api/v1/movie/{movie}                    |
| PATCH | api/v1/movie/{movie}                    |
| GET | api/v1/movie/{movie}                    |
| POST | api/v1/turn                             |
| GET | api/v1/turn                             |
| DELETE | api/v1/turn/{turn}                      |
| PATCH | api/v1/turn/{turn}                      |
| GET | api/v1/turn/{turn}                      |

For complete list of urls in your terminal type and execute

        php artisan r:l
