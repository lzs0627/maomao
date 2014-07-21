<?php
namespace Maomao\Core\Database\Driver;

use \Maomao\Core\Database\Driver as Driver;

/**
 * Description of Pdo
 *
 * @author lizhaoshi
 */
class Pdo extends Driver
{

    public $dbType = '';

    public function __construct($name, array $config)
    {
        parent::__construct($name, $config);
    }

    public function connect()
    {
        if ($this->connection) {
            return ;
        }

        extract($this->config['connection'] + array(
            'dsn'        => '',
            'username'   => null,
            'password'   => null,
            'persistent' => false,
            'compress'   => false,
        ));

        $collon_pos = strpos($dsn, ':');
        $this->dbType = $collon_pos ? substr($dsn, 0, $collon_pos) : null;

        // Force PDO to use exceptions for all errors
        $attrs = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);

        $persistent === true and $attrs[\PDO::ATTR_PERSISTENT] = true;

        if (in_array(strtolower($this->dbType), array('mysql', 'mysqli')) && $compress) {
            // Use client compression with mysql or mysqli (doesn't work with mysqlnd)
            $attrs[\PDO::MYSQL_ATTR_COMPRESS] = true;
        }

        try {
            // Create a new PDO connection
            $this->connection = new \PDO($dsn, $username, $password, $attrs);
        } catch (\PDOException $e) {
            $error_code = is_numeric($e->getCode()) ? $e->getCode() : 0;
            throw new \Exception(str_replace($password, str_repeat('*', 10), $e->getMessage()), $error_code);
        }

        if (! empty($this->config['charset'])) {
            // Set Charset for SQL Server connection
            if (strtolower($this->driverName()) == 'sqlsrv') {
                $this->connection->setAttribute(\PDO::SQLSRV_ATTR_ENCODING, \PDO::SQLSRV_ENCODING_SYSTEM);
            } else {
                // Set the character set
                $this->setCharset($this->config['charset']);
            }
        }

    }

    public function setCharset($charset)
    {
        // Make sure the database is connected
        $this->connection();

        // Execute a raw SET NAMES query
        $this->connection->exec('SET NAMES '.$charset);
    }

    public function errorInfo()
    {
        return $this->connection->errorInfo();
    }

    public function disconnect()
    {
        // Destroy the PDO object
        $this->connection = null;

        return true;
    }

    /**
     * Get the current PDO Driver name
     *
     * @return string
     */
    public function driverName()
    {
        return $this->connection->getAttribute(\PDO::ATTR_DRIVER_NAME);
    }

    public function query($sql)
    {
        $this->connection();

        try {
            $result = $this->connection->query($sql);
        } catch (\Exception $e) {
            $err_code = is_numeric($e->getCode()) ? $e->getCode() : 0;
            $err_msg = $e->getMessage().' with query: "'.$sql.'"';
            throw new \Exception($err_msg, $err_code);
        }

        $this->lastQuery = $sql;
        $type = $this->sqlType($sql);

        if ($type === static::SELECT_TYPE) {
            $result = $result->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } elseif ($type === static::INSERT_TYPE) {
            // Return a list of insert id and rows created
            return array(
                $this->connection->lastInsertId(),
                $result->rowCount()
            );
        } else {
            // Statement's errorCode() returns an empty string before execution,
            // and '00000' (five zeros) after a sucessfull execution:
            return $result->errorCode() === '00000' ? $result->rowCount() : -1;
        }

    }

    public function listTables($like = null)
    {
        throw new Exception('Database method '.__METHOD__.' is not supported by '.__CLASS__, 0);
    }

    public function listColumns($table, $like = null)
    {
        throw new \Exception('Database method '.__METHOD__.' is not supported by '.__CLASS__, 0);
    }

    public function inTransaction()
    {
        return $this->inTransaction;
    }

    public function startTransaction()
    {
        $this->connection();
        $this->inTransaction = true;

        return $this->connection->beginTransaction();
    }

    public function commitTransaction()
    {
        $this->inTransaction = false;

        return $this->connection->commit();
    }

    public function rollbackTransaction()
    {
        $this->inTransaction = false;

        return $this->connection->rollBack();
    }
}
