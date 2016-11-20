# db-slug
Mass slugify existing database column

## Installation
```php
composer require buchin/db-slug
```
## Usage
```php
<?php
use Buchin\DbSlug\DbSlug;

$dsn = "mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=test";
$user = "root";
$password = "root";

$dbSlug = new DbSlug($dsn, $user, $password);

// $column can be multiple
$column = ['title'];
$table = 'post';

$dbSlug->slug($table, $column);

```
