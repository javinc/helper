<?php //-->
/*
 *	Query v2.0;
 *	Basic query helper with database connection
 *	01-20-2014
 *	jAvinc
 */
class Query {

	private $db = null;
	private $table = null;
	private $defaultTable = null;
	private $debug = false;
	private $orderBy = null;
	private $limit = null;
	private $join = null;

	// setting defatuls
	public function __construct($db = null, $table = null) {
		$this->table = $this->defaultTable = $table;
		$this->db = $db;

		return $this;
	}

	// db connection
	public function connect($setting) {
		$con = mysql_connect($setting['host'], $setting['user'], $setting['pass']) or die(mysql_error());
		return $con == true ? mysql_select_db($setting['db'], $con) : die('Error in connect()');
	}

	public function update(array $data, $where) {
		$b = $this->checkWhere($where);
		$v = ' WHERE '.$b;
		$c = ' SET '.$this->extract($data, ',');
		$x = $this->table;
		$z = 'UPDATE ';

		return $this->query($z.$x.$c.$v);
	}

	public function select($where = '1', $columns = null, $op = 'AND') {
		$b = $this->checkWhere($where, $op);
		$v = ' WHERE '.$b.' '.$this->orderBy.($this->limit ? $this->limit : null);
		$c = 'FROM '.$this->table.' '.($this->join ? $this->join : null);
		$x = $columns == null ? ' * ' : $this->extract($columns,',','`');
		$z = 'SELECT ';
		
		return $this->returner($this->query($z.$x.$c.$v));
	}

	public function insert($data) {
		$v = $this->extract($data,',');
		$c = $this->isAssoc($data) ? " SET {$v}" : "values( {$v} )";
		$x = $this->table;
		$z = 'INSERT INTO ';
		
		return $this->query($z.$x.$c);
	}

	public function delete($where) {
		$c = $this->checkWhere($where);
		$v = ' WHERE '.$c;
		$x = $this->table;
		$z = 'DELETE FROM ';
		
		return $this->query($z.$x.$v);
	}

	public function search($where, $columns = null) {
		
		$b = $where;
		if(is_array($b)) {
			$b = $this->extract($b, 'OR', "'", ' LIKE ');
		}
		
		$v = ' WHERE '.$b.' '.$this->orderBy.($this->limit ? $this->limit : null);
		$c = 'FROM '.$this->table.' '.($this->join ? $this->join : null);
		$x = $columns == null ? ' * ' : $this->extract($columns,',','`');
		$z = 'SELECT ';
		
		return $this->returner($this->query($z.$x.$c.$v));
	}
	
	// set joins
	public function setJoin($join) {
		$this->join = $join;

		return $this;
	}

	// set order by
	public function setOrderBy($order) {
		$this->orderBy = $this->checkWhere($order);

		return $this;
	}

	// set table
	public function setTable($table) {
		$this->table = $table;

		return $this;
	}

	// set limit
	public function setLimit(int $start, int $end) {
		$this->limit = ' LIMIT '.$start.' , '.$end;

		return $this;
	}

	// show sql query. False by default
	public function debug() {
		$this->debug = true;

		return $this;
	}

	// query
	public function query($query) {
		// reset vars
		$this->orderBy = null;
		$this->limit = null;
		$this->join = null;
		$this->table = $this->defaultTable;

		if($this->debug){
			echo $query.'<br>';
		}

		// trap when table is null
		if($this->table) {
			if($this->db) {
				return mysql_query($query, $this->db);
			}

			return mysql_query($query);
		}

		return false;
	}

	// check use raw or extract
	private function checkWhere($data, $op = 'AND') {
		return is_array($data) ? $this->extract($data, $op) : $data;
	}

	// store data to array
	private function returner($query){
		$arr = array();
		while($row = mysql_fetch_assoc($query)) {
			$arr[] = $row;
		}
		
		return $arr;
	}

	// check if assoc array
	private function isAssoc(array $data) {
		foreach($data as $key => $val){
			if(is_int($key)) {
				return false;
			}
			
			return true;
		}
	}

	// generate sql clause and extract array
	private function extract(array $data, $sep = null, $clause = "'", $op = '=') {
		$arr = array();
		foreach($data as $key => $val) {
			$val = $this->clean($val);
			
			$r = null;
			if($this->isAssoc($data)) {
				$r = " {$key}{$op}"; //one by one method 
			}
			$arr[] = $r."{$clause}{$val}{$clause} "; //required all but short cut method
		}

		return implode($sep, $arr);
	}

	// clean inputs
	private function clean($data){
		return mysql_real_escape_string(htmlentities(trim($data)));
	}
}
