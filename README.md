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
## Where NOT statement
```PHP
(new Users)
    ->whereNot('id', 1)
    ->whereNot(['age' => 24, 'name' => 'asmthry']);
```

## Where IN statement
```PHP
(new Users)
    ->whereIn('id', [1, 2]);
```

## Where NOT IN statement
```PHP
(new Users)
    ->whereNotIn('id', [1, 2]);
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