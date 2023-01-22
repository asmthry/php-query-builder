<?php

namespace Asmthry\PhpQueryBuilder\MySql;

use Asmthry\PhpQueryBuilder\Exceptions\FnNotFoundException;
use Asmthry\PhpQueryBuilder\Exceptions\InvalidDetailsException;
use Asmthry\PhpQueryBuilder\Exceptions\ItemNotFoundException;
use Exception;
use PDO;

class Connection
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

        if (isset(static::$database)) {
            return;
        }

        try {
            static::$database = new PDO(
                "mysql:dbname={$details['database']};host={$details['host']}",
                $details['username'],
                $details['password'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );
        } catch (Exception $e) {
            throw new InvalidDetailsException();
        }
    }

    /**
     * Validate the all database connection details is available
     *
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
