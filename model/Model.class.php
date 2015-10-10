<?php 
/**
file: Model.class.php
功能: 数据库表的基类
**/
defined('HSSH') || exit("Denied access");
class Model {
	protected $table = NULL;
	protected $db = NULL;

	public function __construct() {
		$this->db = mysql::getIns();
	}

    // select
    public function getOne($sql) {
        return $this->db->getOne($sql);
    }

    // select 一行数据
    public function getRow($sql) {
        return $this->db->getRow($sql);
    }

    // select 多行数据
    public function getAll($sql) {
        return $this->db->getAll($sql);
    }

    // select 数据
    public function select($arr, $where="1") {
        return $this->db->autoExecute($this->table, $arr, 'select', $where);
    }

    // update 数据
    public function update($arr, $where) {
        $this->db->autoExecute($this->table, $arr, 'update', $where);
        return $this->db->affected_rows();
    }

    // insert 数据
    public function insert($arr) {
        $this->db->autoExecute($this->table, $arr, 'insert');
        return $this->db->affected_rows();
    }

    // delete 数据
    public function delete($where) {
        return $this->db->delete($this->table, $where);
    }

    // 只取多行值
    public function getOneAllValue($field,$where) {
        $sql = "select $field from $this->table where " . $where;
        return $this->db->getOneAll($sql,$field);
    }


}

 ?>