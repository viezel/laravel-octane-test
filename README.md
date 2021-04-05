# Laravel Octane Benchmark testing (WORK IN PROGRESS)

This app is a vanilla Laravel 8. I did not install any extra composer packages, expect a dev package to run locally in docker.

We will be using [wrk](https://github.com/wg/wrk) to perform the tests


## What we want to test 

Comparing PHP-FPM vs Swoole in: 

- Basic throughput benchmark 
- Sync vs async MySQL and Redis
- Importance of connection pools


## The Tests

We will be using the following API endpoints to test performance.

| Route | Response | MySQL | Redis  |
|:-----:|:--------:|:-----:|:------:|
| /api/ping | Returns a string | No | No |
| /api/users | Returns a paginated list of users | Yes | No |
| /api/users/:id | Returns a user | Yes | No |

We will be running the following commands using wrk. 

`wrk -t4 -c50 http://localhost/api/ping` 
`wrk -t4 -c50 http://localhost/api/users` 
`wrk -t4 -c50 http://localhost/api/users/1` 

| Route          |  FPM-Docker | Swoole-Docker | 
|:--------------:|:-----------:|:-------------:|
| /api/ping      | 155 req/sec | N/A req/sec   |
| /api/users/:id |  96 req/sec | N/A req/sec   |


## Get started locally

- clone repo
- run `composer install`
- run `dock start` to run in docker
- run `dock art db:seed` to generate 5000 users

