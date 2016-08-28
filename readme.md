Laravel Scout + TNT Search
===================

This is really simple full text search integrating with Laravel Scout + TNT Search + Vuejs.

----------
**Step.0**
Edit .env file with your credentials.

**Step.1**
Migrate database.
```
php artisan migrate 
```
**Step.2**
Go to tinker.
```
php artisan tinker
```
**Step.3**
Create dummy users 500 within tinker with model factory.
```
factory(App\User::class, 500)->create();
```
**Step.4**
Import Users to scout.
```
php artisan scout:import 'App\User'
```