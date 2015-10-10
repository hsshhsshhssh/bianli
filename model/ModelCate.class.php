<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 18:43
 */
defined('HSSH') || exit("Denied access");

class ModelCate extends Model {
    protected $table = null;
    protected static $_ins = null;

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