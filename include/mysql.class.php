<?php 

/**
file: mysql.class.php
功能: 具体实现数据库的功能
**/
defined('HSSH') || exit("Denied access");
class mysql extends db {
	private $conf = array();
	private $conn = NULL; // 连接数据库的资源
	private static $ins = NULL; // 单例模式

	protected function __construct() {
		$this->conf = conf::getIns();

		//连接mysql
		$this->connect($this->conf->host, $this->conf->user, $this->conf->pwd);
		//选择数据库
		$this->select_db($this->conf->db);
		//选择字符集
		$this->setChar($this->conf->char);
	}

	public static function getIns() {
		if(!(self::$ins instanceof self)) {
			self::$ins = new self();
		}

		return self::$ins;
	}

	public function __destruct() {

	}


	//连接mysql
	public function connect($h, $u, $p) {
		$this->conn = mysqli_connect($h, $u, $p);
		
		if($this->conn->connect_error) {
			// $err = new Exception('连接数据库失败');
			// throe $err;
			log::write("connect mysql fail");
		}
		log::write("connect mysql success");
	}

	//选择数据库
	protected function select_db ($db) {
		$sql = 'use ' . $db; //拼接sql语句
		$this->query($sql); //发送一条mysql查询
	}

	// 设置字符集
	protected function setChar($char) {
		$sql = 'set names ' . $char;
		$this->query($sql); 
	}

	//发送一条mysql查询 返回一个资源
	public function query ($sql) {
		$rs = mysqli_query($this->conn , $sql);
		log::write($sql); //log::write("  result:" . $rs);
		return $rs;
	}

	//查询多行数据
	public function getAll($sql){
		//echo $sql , '<br />';
		$rs = $this->query($sql);
		$list = array();
		while($row = mysqli_fetch_assoc($rs)) {
			$list[] = $row;
		}
		return $list; //list为二维数组
	}



	//查询单行数据
	public function getRow($sql) {
		$rs = $this->query($sql);
		return  mysqli_fetch_assoc($rs); //返回一维数组
	}

	//查询单个数据
	public function getOne($sql) {
		$rs = $this->query($sql);
		$row = mysqli_fetch_row($rs);
		return $row[0];
	}

    public function getOneAll($sql, $field) {
        $rs = $this->query($sql);
        $temp = array();
        while($row = mysqli_fetch_assoc($rs)) {
            $temp[] = $row[$field];
        }
        return $temp;
    }

	//自动生成、执行insert/update
	public function autoExecute($table, $arr, $mode = 'insert', $where = '1 limit 1') {

        // 可定义select操作
        if($mode == 'select') {
            $sql = 'select ';
            if(is_array($arr)){
                $sql .= implode(',', array_values($arr));
            }
            else {
                $sql .= '*';
            }
            $sql .= ' from ' . $table . ' where ' . $where;
            return $this->getAll($sql);  // 返回查询多行的结果
        }

        // insert update 操作arr必须为数组
        if(!is_array($arr)) {
            return ;
        }

		if($mode == 'update') {
			$sql = 'update ' . $table . ' set ' ;
			foreach ($arr as $k=>$v) { //$k为旧值 $v为新值
				$sql .=$k . "='" . $v . "',";
			}
			$sql = rtrim($sql, ','); //取出末尾的逗号
			$sql .=' where ' . $where;
		}
        else {

			// insert语句
			$sql = 'insert into ' . $table . ' (' . implode(',', array_keys($arr)) . ')';
			$sql .= ' values (\'';
			$sql .= implode("','", array_values($arr));
			$sql .= '\')';		
		}
		return $this->query($sql);
	}

	//返回影响行数的函数
	public function affected_rows() {
//		return mysql_affected_rows($this->conn);
        return $this->conn->affected_rows ;
	}

	//返回最新的auto_increment列的自增长的值
	public function insert_id() {
		return mysql_insert_id($this->conn);
	}


    // delete
    public function delete($table,$where) {
        if($where === true || $where === 1) return;

        $sql = 'delete from ' . $table . ' where ' . $where;
        $this->query($sql);
        return $this->affected_rows();
    }
}

 ?>