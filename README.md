# PHP test

## 1. Installation

  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - copy .env.example to .env and set your database credentials
  - you can test the demo script in your shell: "php index.php"

## 2. Changes
  - added strict typing
  - added autoloader to load env and bind classes
  - added `services.php` file to map interfaces to classes
  - created Container class to auto resolve classes with dependency injection using `config/services.php` to bind interfaces to classes
  - created DB class to handle database connection and queries
