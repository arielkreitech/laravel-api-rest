<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Introduction
Welcome to the Laravel API project! This project is designed to showcase the implementation of a basic RESTful API using Laravel, with a focus on user authentication and token management using Sanctum. The API includes a full CRUD (Create, Read, Update, Delete) functionality for managing users, all secured through token-based authentication.

## Features
- `Token Management`: The project integrates Laravel Sanctum for secure token-based authentication, ensuring a robust and reliable mechanism for handling user logins and tokens.

- `User CRUD Operations`: The API provides endpoints for creating, reading, updating, and deleting user records. This allows for seamless user management within the system.

- `Layered Architecture`: The project is structured with a layered architecture, utilizing services and repositories. This separation of concerns enhances code maintainability, readability, and scalability.

## Getting Started
To set up and run the project locally, follow these steps:
#### 1. Clone the Repository:
 - `git clone https://github.com/aldoimeadios/laravel-api-rest.git`
 - `cd laravel-api-rest`
#### 2. Install Dependencies:
 - `composer install`
#### 3. Configure Environment:
 - Copy the `.env.example` file to `.env` and update the database and Sanctum configuration settings.
#### 4. Generate Application Key:
 - `php artisan key:generate`
#### 5. Run Migrations and Seed Database:
 - `php artisan migrate --seed`
#### 6. Start the Development Server:
 - `php artisan serve`

## Usage
The API is now ready to use! You can make requests to the various endpoints for user management and authentication.
### Authentication
 - Register a new user: `POST /api/signup`
 - Login user: `POST /api/login`
 - Logout user: `GET /api/logout`
### User Management
 - Retrieve all users: `GET /api/users`
 - Retrieve a specific user by id: `GET /api/users/{id}`
 - Retrieve a specific user by email: `GET /api/user_by_email`
 - Create a new user: `POST /api/users`
 - Update a user:: `PUT /api/users/{id}`
 - Delete a user:: `DELETE /api/users/{id}`

## Contribute
Feel free to contribute to the project by submitting issues or pull requests. Your feedback and contributions are highly appreciated!

## License
This Laravel API project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**


## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.
