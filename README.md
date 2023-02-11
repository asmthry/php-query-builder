# PHP Query Builder

## Setup Query builder library

```PHP
<?php

namespace App\Asmthry\Demo;

require_once "../vendor/autoload.php";

use Asmthry\PhpQueryBuilder\MySql;

class Model extends MySql
{
    protected function database(): array
    {
        return [
            'host' => 'localhost',
            'username' => '{username}',
            'password' => '{password}',
            'database' => '{database}'
        ];
    }
}
```

## Set table name

```PHP
// Select data from users table
(new Model)->from('users'); 

// Or you can define $table property in your class
class Users extends Model{
    protected $table = 'users';
}

// Select data from 'users' table
(new Users); 
```

## Select fields from table

```PHP
(new Users)
   ->select('id')
   ->select(['name','age'])
   ->select('email', 'phone')
   ->get();
```

## Where statement

```PHP
(new Users)
    ->where('id', 1)
    ->where(['age' => 24, 'name' => 'asmthry']);
```
## OR Where statement

```PHP
(new Users)
    ->where('id', 1)
    ->orWhere(['age' => 24, 'name' => 'asmthry']);
```
## Where NOT statement
```PHP
(new Users)
    ->whereNot('id', 1)
    ->whereNot(['age' => 24, 'name' => 'asmthry']);
```
## OR Where NOT statement
```PHP
(new Users)
    ->whereNot('id', 1)
    ->orWhereNot(['age' => 24, 'name' => 'asmthry']);
```
## Where IN statement
```PHP
(new Users)
    ->whereIn('id', [1, 2]);
```
## OR Where IN statement
```PHP
(new Users)
    ->where('id', 1)
    ->orWhereIn('id', [3, 4]);
```
## Where NOT IN statement
```PHP
(new Users)
    ->whereNotIn('id', [1, 2]);
```
## OR Where NOT IN statement
```PHP
(new Users)
    ->where('id', 1)
    ->orWhereNotIn('id', [3, 4]);
```
## Where grouping

```PHP
(new Users)
    ->groupStart()
    ->where('id', 1)
    ->where(['age' => 24, 'name' => 'asmthry'])
    ->groupEnd()
```
### Where AND grouping

```PHP
(new Users)
    ->groupStart()
    ->where('id', 1)
    ->where('age', 24)
    ->groupEnd()
    ->andGroupStart()
    ->where('id', 2)
    ->where('age', 25)
    ->groupEnd()
```
### Where OR grouping

```PHP
(new Users)
    ->groupStart()
    ->where('id', 1)
    ->where('age', 24)
    ->groupEnd()
    ->orGroupStart()
    ->where('id', 2)
    ->where('age', 25)
    ->groupEnd()
```

### Create new record
```php
$obj = new Users;
$obj->name = 'asmthry';
$obj->email = 'info@asmthry.in';
$obj->age = '24';
$obj->save();
```