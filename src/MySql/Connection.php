<?php

/*
 * This file is part of the asmthry package.
 *
 * (c) asmthry <asmthry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asmthry\PhpQueryBuilder\MySql;

use Asmthry\PhpQueryBuilder\Exceptions\FnNotFoundException;
use Asmthry\PhpQueryBuilder\Exceptions\InvalidDetailsException;
use Asmthry\PhpQueryBuilder\Exceptions\ItemNotFoundException;
use Exception;
use PDO;

class Connection
{
    private static $database;

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
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
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

    /**
     * Prepare query and replace dynamic values
     *
     * @param string $query Query string
     * @param array $values Parameters to replace values
     */
    public function executeQuery(string $query, array $values = [])
    {        
        $query = static::$database->prepare($query);
        $query->execute($values);

        return $query;
    }

    public function __destruct()
    {
        static::$database = null;
    }
}
