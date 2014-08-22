<?php


namespace Maomao\Core\Model;

use Maomao\Core\Object as Object;
use Maomao\Core\Database\DB as DB;
/**
 * Description of DB
 *
 * @author lizhaoshi
 */
class Base extends Object
{
	protected $table;
	protected $db_wirte;
	protected $db_read;

	protected $prepare_sql;

	CONST NO_ESCAPE_PREFIX = '__NOESCAPE__::';

	public function __construct($db_read_name = null, $db_write_name = null)
	{
		$this->db_read = DB::instance($db_read_name);
		$this->db_wirte = DB::instance($db_write_name);
	}


	public function select($arr_fields)
	{
		$select = array();

		if (! is_array($arr_fields)) {
			$arr_fields = array($arr_fields);
		}

		foreach ($arr_fields as $field=>$val) {
			if (is_int($field)) {
				$select[] = $val;
			} else {
				$select[] = $field . ' AS ' . $val;
			}
		}

		$this->prepare_sql = 'SELECT ' . implode(',', $select);

		return $this;

	}

	public function update($tables, $fields)
	{
		if (! is_array($tables)) {
			$tables = array($tables);
		}

		$tbl = array();

		foreach ($tables as $k=>$v) {
			if (is_int($k)) {
				$tbl[] = $v;
			} else {
				$tbl[] = $k . ' AS ' . $v;
			}
		}

		$this->prepare_sql = 'UPDATE ' . implode(',', $tbl);

		$set = array();
		foreach ($fields as $f=>$v) {
			if (is_int($v)) {
				$set[] = $f . '=' . $v;
			} else {
				$set[] = $f . '=' . "'" . addslashes($v) . "'";
			}
		}

		$this->prepare_sql .= ' SET ' . implode(',', $set);

		return $this;
	}


	public function delete($tables = null)
	{
		if (is_null($tables)) {
			$this->prepare_sql = 'DELETE';
		} else {
			$this->prepare_sql = 'DELETE ' . $tables;
		}
	}

	public function insert($table, $field_vals)
	{
		$this->prepare_sql = 'INSERT INTO ' . $table;

		$fields = array();
		$values = array();

		foreach ($field_vals as $f=>$v) {
			$fields[] = $f;
			if (is_int($v)) {
				$values[] = $v;
			} else {
				$values[] = "'" . addslashes($v) . "'";
			}
		}

		$this->prepare_sql .= '(' . implode(',', $fields) . ')'
							. ' VALUES (' . implode(',', $values);
	}



	public function from($table)
	{
		if (! is_array($table)) {
			$table = array($table);
		} 

		$tables = array();
		foreach ($table as $t=>$a) {
			if (is_int($t)) {
				$tables[] = $a;
			} else {
				$tables[] = $t . ' AS ' . $a;
			}
		}

		$this->prepare_sql .= ' FROM ' . implode(',', $tables);

		return $this;
	}

	public function join($table, $type, $conditions)
	{
		$this->prepare_sql .= ' ' . $type . ' JOIN ' . $table;

		if ($conditions) {
			$this->prepare_sql .= ' ON ' . static::forge_condition($conditions);
		}

		return $this;
	}


	public function where($conditions){
		
		$this->prepare_sql .= ' WHERE ' . static::forge_condition($conditions);

		return $this;
	}

	public function group($str)
	{
		$this->prepare_sql .= ' GROUP BY ' . $str;

		return $this;
	}

	public function having($condition)
	{
		$this->prepare_sql .= ' HAVING ' . static::forge_condition($conditions);

		return $this;
	}

	public function limit($offset, $count)
	{
		$this->prepare_sql .= ' LIMIT ' . intval($offset) . ',' . intval($count);

		return $this;
	}


	public function execute()
	{
		return $this->prepare_sql;
	}


	public static function forge_condition($conditions, $type = 'AND')
	{
		if (! is_array($conditions)) {

			return static::escapecheck($conditions);
		}

		$con_str = array();

		foreach ($conditions as $k => $v) {
			if ((strtoupper($k) == 'OR' || strtoupper($k) == 'AND') && is_array($v)) {
				$con_str[] = '(' . static::forge_condition($v, strtoupper($k)) . ')';
			}
			$str = '';
			if (is_string($k) && ! is_array($v)) {
				$con_str[] = $k . static::escapecheck($v);
			} elseif (is_int($k) && is_string($v)) {
				$con_str[] = static::escapecheck($v);
			}
			
		}

		return implode(' ' . $type . ' ', $con_str);

	}

	public static function sql_escape($str)
	{
		//シングルクォート('), ダブルクォート("),バックスラッシュ (\) ,NUL (NULL バイト) 
		$str = addslashes($str);

		//(,),%,*
		$str = str_replace(array('(',')','%','*'), array('\\(','\\)','\\%','\\*'), $str);

		return $str;

	}

	public static function escapecheck($sql)
	{
		if (strpos($sql, static::NO_ESCAPE_PREFIX) !== false) {
			return str_replace(static::NO_ESCAPE_PREFIX, '', $sql);
		}

		if (is_numeric($sql)) {
			return $sql;
		}

		return "'" . static::sql_escape($sql) . "'";
	}

}