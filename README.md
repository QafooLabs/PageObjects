# Page Objects

Repository with an example for page objects

> *Disclaimer: This is not an official Qafoo product but a prototype. We don't
> provide support on this repository.*

# Usage

To install all dependencies run something like:

    composer install

# Run the tests

To run all tests just run:

    vendor/bin/phpunit

For the tests to work you must provide valid login data which, depending on
your shell, yould be done like:

    env USER="me@example.com" PASSWORD="password" vendor/bin/phpunit

