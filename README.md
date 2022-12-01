## Instructions

Clone the repository

    git clone https://github.com/godfredakpan/elevation-church-CRUD.git

Switch to the repo folder

    cd elevation-church-CRUD

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Run the database seeder and you're done

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
