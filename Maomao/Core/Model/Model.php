<?php


namespace Maomao\Core\Database;

use Maomao\Core\Object as Object;

/**
 * Description of DB
 *
 * @author lizhaoshi
 */
clase Model extends Object
{
	protected $table;
	protected $db_wirte;
	protected $db_read;

	protected $prepare_sql;

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

		foreach ($arr_fields as $group=>$val) {
			if (is_int($val)) {
				$select[] = $val;
			} else {
				$select[] = $group . ' (' . $val . ')';
			}
		}

		$this->prepare_sql = 'SELECT ' . implode(',', $select);

		return $this;

	}


	public function from($table)
	{
		if (! is_array($table)) {
			$table = array($table);
		} 

		$tables = array();
		foreach ($table as $t=>$a) {
			if (is_int($a)) {
				$tables[] = $t;
			} else {
				$tables[] = $t . ' AS ' . $a;
			}
		}

		$this->prepare_sql .= ' FROM ' . implode(',', $tables)

		return $this;
	}

	public function join($table, $type, $conditions)
	{
		$this->prepare_sql .= ' ' . $type . ' JOIN ' . $table;

		if (is_string($conditions)) {
				$this->prepare_sql .= ' ON ' . $conditions;
		} elseif(is_array($conditions)) {
			
		}

		return $this;

	}



	public static function forge_condition($conditions)
	{
		
	}



}