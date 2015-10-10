<?php 
/**
file: ModelTest.class.php
功能: 具体实现Test表的功能
**/
defined('HSSH') || exit("Denied access");

class ModelUser extends Model {
	protected $table = null;

	public function __construct($table) {
        parent::__construct();
        $this->table = $table;
    }

    public function reg($data) {
		return $this->db->autoExecute($this->table, $data, 'insert');
	}

//	public function select() {
//		return $this->db->getAll('select * from ' . $this->table);
//	}


}

 ?>