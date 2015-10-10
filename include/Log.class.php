<?php   
/**
file: log.class.php
功能: 日志类
**/
defined('HSSH') || exit("Denied access");
class Log {

	const LOGFILE = 'curr.log';

	// 写日志
	public static function write($cont) {
		$cont = $cont . "\r\n";
		$log = self::getLog();

		$fh = fopen($log, 'ab');
		fwrite($fh, $cont);
		fclose($fh);
		return true;
	}


	// 备份日志 如果文件大于1M就以年月日的形式存下来
	public static function bak($log) {
		$bak = ROOT . 'data/log/' . date('ymd') . '_' . mt_rand(10000,99999) . '.bak';
		echo "$bak" . '<br />';
		return rename($log, $bak);
	}

	//判断当前日志文件的大小 返回可以写入的日志文件路径
	public static function getLog() {
		$log = ROOT . 'data/log/' . self::LOGFILE;

		if(!file_exists($log)) { //文件不存在
			touch($log);
			return $log;
		} else { //文件存在 判断大小
			clearstatcache(true, $log); //将缓存的数据存到硬盘中 消除缓存对读文件大小的影响
			$size = filesize($log);
			if($size <= 1024*1024) {// 当前文件小于1M
				return $log;
			} else { //当前文件大于1M
				if(!self::bak($log)) { // 备份文件
					return $log; 
				} else {
					touch($log); // 备份成功 创建新的日志文件
					return $log;
				}
			}
		}


	}


}



?>