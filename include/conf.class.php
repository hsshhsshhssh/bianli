<?php 
/**
file: conf.class.php
功能: 封装配置文件
**/
defined('HSSH') || exit("Denied access");

class conf {
	protected static $ins = null;
	protected $data = array();

	//构造函数
	final protected function __construct() {
		//include(ROOT . 'include/conf.inc.php');
		include('config.inc.php');
		$this->data = $_CFG;
	}

	//拷贝函数
	final protected function __clone() {

	}

	//单例模式
	public static function getIns() {
		if(self::$ins instanceof self) {
			return self::$ins;
		} else {
			self::$ins = new self();
			return self::$ins;
		}
	}

	//魔术方法之__get()
	public function __get($key) {
		if(array_key_exists($key, $this->data)) {
			return $this->data[$key];
		} else {
			return null;
		}
	}

	//魔术方法之__set()
	public function __set($key, $value) {
		$this->data[$key] = $value;
	}

}
 ?>