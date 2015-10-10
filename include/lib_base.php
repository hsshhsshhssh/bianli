<?php 
/**
 *file: lib_base.php 基本函数的定义
 *功能: 用递归实现转义
**/
defined('HSSH') || exit("Denied access");
function _addslashes($arr) {
	foreach ($arr as $key => $value) {
		if(is_string($value)) { //数组元素是一个字符串 直接转义即可
			$arr[$key] = addslashes($value);
		} 
		else if(is_array($value)) { //数组元素是数组 递归转义
			$arr[$key] = _addslashes($value);
		} 
		else { //数组元素存在其他元素 属于错误情况
			return NULL;
		}
	}
	return $arr;
}

// $arr = array('a"b',array("c'b",array('e"f')));
// var_dump(_addslashes($arr));

// 获取用户端的IP
function get_client_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[d.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}



 ?>