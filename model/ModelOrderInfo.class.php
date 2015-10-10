<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/9
 * Time: 19:39
 */
defined('HSSH') || exit("Denied access");

class ModelOrderInfo extends Model
{
    protected $table = null;
    protected static $_ins = null;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }


    public function reg($data)
    {
        return $this->db->autoExecute($this->table, $data, 'insert');
    }

    // 新插入订单信息
    public function insertOrder($arr) {
        if($this->insert($arr) == 1) {
            // 插入成功 返回订单id
            return $this->getOne('select order_id from ' . $this->table . ' where order_sn="' . $arr['order_sn'] . '"');
        }
        else {
            return false;
        }
    }
}

