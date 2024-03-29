# API Bridge

Laravel app that collects new records created in a database, processes them based on some criteria, and publishes them to a Kafka Event stream to be consumed by another API.

This was built for the purpose of Migrating a large amount of data from an older system to a newer one.

## Deploy Instructions

-   Pull repo
-   ensure correct php pdo drivers are installed for ms sql. odbc or libdb.
-   `composer install`
-   `cp .env.example .env`
-   Edit environment variables in .env appropriately; fill in DB_WALTER and DB_STATS env vars
-   Add Sentry environment variable `SENTRY_LARAVEL_DSN=`
-   Set redis environment variables
    ```
      QUEUE_CONNECTION=redis
      REDIS_HOST=
      REDIS_PASSWORD=
      REDIS_PORT=
      REDIS_PREFIX=
    ```
-   Set up systemd services for `php artisan kafka:consume` and `php artisan queue:work`

## Running Locally

-   Pull repo
-   ensure correct php pdo drivers are installed for ms sql. odbc or libdb.
-   `composer install`
-   `cp .env.example .env`
-   Run `touch database/testing.sqlite && touch database/testing-stats.sqlite && touch database/walter-testing.sqlite`
-   Update `SSL_CA_FILE` env variable

## Running Tests

-   `./vendor/bin/phpunit`
