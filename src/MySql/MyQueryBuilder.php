<?php

namespace Asmthry\PhpQueryBuilder\MySql;

use Asmthry\PhpQueryBuilder\Exceptions\FnNotFoundException;
use Asmthry\PhpQueryBuilder\Exceptions\ItemNotFoundException;
use PDO;

class MyQueryBuilder
{
    private static PDO $database;

    public function __construct()
    {
        $this->createConnection();
    }
    
    /**
     * Create database connection
     */
    private function createConnection()
    {
        if (!method_exists($this, 'database')) {
            throw new FnNotFoundException('database');
        }

        $details = $this->getDetails();

        static::$database = new PDO(
            "mysql:dbname={$details['database']};host={$details['host']}",
            $details['username'],
            $details['password'],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]
        );
    }

    /**
     * Validate the all database connection details is available
     *
     * $details = array(
     *   'host' => 'Hostname',
     *   'username' => 'Database username',
     *   'password' => 'Database password',
     *   'database' => 'Database name'
     * );
     * @return connection details
     */
    private function getDetails()
    {
        $details = $this->database();

        if (!array_key_exists("host", $details)) {
            throw new ItemNotFoundException("hostname");
        }

        if (!array_key_exists("username", $details)) {
            throw new ItemNotFoundException("username");
        }

        if (!array_key_exists("password", $details)) {
            throw new ItemNotFoundException("password");
        }

        if (!array_key_exists("database", $details)) {
            throw new ItemNotFoundException("database");
        }

        return $details;
    }
}
