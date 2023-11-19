# Simple Auth

Build simple auth

## Installation

Clone the repo `https://github.com/Moemen-Gaballah/Simple-Secured-Authentication-API.git` and `cd` into it

Rename or copy `.env.example` file to `.env`

Set your database credentials in your `.env` file

Don't forget Set your database.

create database `simple-auth` for unit test.

`composer install`

`php artisan serve`

Postman Collection in root project  : `Auth-secure.postman_collection.json`

### Done

- [x] Localized URL (EN/AR).
- [x] Login Endpoint that retrieves id, name, email Through UserResource.
- [x] Login MUST use cookies in an encrypted/secure way to store the token.
- [x] If the user has been logged-in successfully MUST kill the other tokens.
- [x] Logout Endpoint that logs out the user from the current device only.
- [x] 2 Forgot Password endpoints (/password/email, /password/reset/{token}).
- [x] Forgot Password sends localized email depending on the given locale in the URL.
- [x] MUST change the mail theme to RTL on AR locale.


### TODO
- [] Need the Forgot Password Notification be Queued and that through using auth queue not default
  one.
- [] Need the Queueing be on Redis.
- [] All config depend on Config not env direct.
- [] Add Repository Pattern
- [] Middleware to redirect if url doesn't have local(ar-en).
- [] Use Eloquent ORM in all project.
- [] Search more about sanctum (and remove middleware LocaleMiddleware)
- [] Use Package Spatie Localization
- [] API Documentation
- etc...

