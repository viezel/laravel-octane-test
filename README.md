# Laravel Octane Benchmark testing (WORK IN PROGRESS)

This app is a vanilla Laravel 8. I did not install any extra composer packages, expect a dev package to run locally in docker.

We will be using [wrk](https://github.com/wg/wrk) to perform the tests


## What we want to test 

Comparing PHP-FPM vs Swoole in: 

- Basic throughput benchmark 
- Sync vs async MySQL and Redis 
- Importance of connection pools
- CPU & memory usage


## The Tests

We define the following API endpoints to test performance. 

```php
Route::get('/ping', function() {
    return response()->json(['message' => 'pong']);
});

Route::get('/users', function () {
    return response()->json(User::query()->paginate());
});

Route::get('/users/{userId}', function (int $userId) {
    return response()->json(User::query()->findOrFail($userId));
});
```

| Route | Response | MySQL | Redis  |
|:-----:|:--------:|:-----:|:------:|
| /api/ping | Returns a string | No | No |
| /api/users | Returns a paginated list of users | Yes | No |
| /api/users/:id | Returns a user | Yes | No |

We will be running the following commands using wrk. We use 4 threads, 50 connections in 30 seconds per test. Commands to run the test:

- `wrk -t4 -c50 -d30s http://localhost/api/ping` 
- `wrk -t4 -c50 -d30s http://localhost/api/users` 
- `wrk -t4 -c50 -d30s http://localhost/api/users/1` 


## Get started locally

- clone repo
- run `composer install`
- run `dock start` to run in docker
- run `dock art db:seed` to generate 5000 users

