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
## Select fields from table

```PHP
(new Users)
   ->select('id')
   ->select(['name','age'])
   ->select('email', 'phone')
   ->get();
```