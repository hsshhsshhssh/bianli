<?php 
/**
file: db.class.php
功能: 数据库抽象类
**/
defined('HSSH') || exit("Denied access");
abstract class db {

	//连接服务器
	public abstract function connect($h, $u, $p);

	//发送查询
	public abstract function query($sql);

	//查询多行数据
	public abstract function getAll($sql);

	//查询单行数据
	public abstract function getRow($sql);

	//查询单个数据
	public abstract function getOne($sql);

	//自动生成、执行insert/update
	public abstract function autoExecute($table, $data, $act = 'insert', $where = '');

}

 ?>