<?php

namespace Maomao\Core\Database;

use Maomao\Core\Object as Object;

/**
 * Description of Driver
 *
 * @author lizhaoshi
 */
abstract class Driver extends Object
{
    protected $instanceName;

    protected $config;

    protected $connection;

    protected $inTransaction = false;

    protected $lastQuery;

    const SELECT_TYPE = 1;
    const INSERT_TYPE = 2;
    const DELETE_TYPE = 3;
    const UPDATE_TYPE = 4;

    /**
     *
     * @param string $name
     * @param array  $config
     */
    protected function __construct($instance_name, array $config)
    {
        $this->instanceName = $instance_name;
        $this->config = $config;
    }

    /**
     *
     */
    final public function __destruct()
    {
        $this->disconnect();
    }

    /**
     *
     * @return type
     */
    final public function __toString()
    {
        return $this->instanceName;
    }

    /**
     * データベースへ接続
     */
    abstract public function connect();

    public function connection()
    {
        // Make sure the database is connected
        $this->connection or $this->connect();

        return $this->connection;
    }

    public function hasConnection()
    {
        // return the status of the connection
        return $this->connection ? true : false;
    }

    public function sqlType($sql)
    {
        $sql = trim($sql);

        if (strpos(strtolower($sql), 'select') === 0) {
            return static::SELECT_TYPE;
        } elseif (strpos(strtolower($sql), 'insert') === 0) {
            return static::SELECT_TYPE;
        } elseif (strpos(strtolower($sql), 'update') === 0) {
            return static::UPDATE_TYPE;
        } elseif (strpos(strtolower($sql), 'delete') === 0) {
            return static::DELETE_TYPE;
        } else {
            return -1;
        }

    }
    /**
     *
     */
    abstract public function disconnect();

    /**
     *
     */
    abstract public function setCharset($charset);

    /**
     *
     */
    abstract public function query($sql);

    /**
     *
     */
    abstract public function errorInfo();

    /**
     *
     */
    abstract public function listTables($like = null);

    /**
     *
     */
    abstract public function listColumns($table, $like = null);

    abstract public function inTransaction();

    abstract public function startTransaction();

    abstract public function commitTransaction();

    abstract public function rollbackTransaction();
}
