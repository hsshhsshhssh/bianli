<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/7
 * Time: 18:44
 */
defined('HSSH') || exit("Denied access");

class ModelGoods extends Model {
    protected $table = null;
    private static $_ins = null;

    public function __construct($table) {
        parent::__construct();
        $this->table = $table;
    }


    public function reg($data) {
        return $this->db->autoExecute($this->table, $data, 'insert');
    }

    // 得到以goods_id为key的关联数组
    public function getAssocTotal($where = '1') {
        $sql = "select goods_id,goods_total";
        $sql .= " from " . $this->table . " where " . $where;
        $rs = $this->db->query($sql);
//        $list = array();
        $temp = array();
        while($row = mysqli_fetch_assoc($rs)) {
            $temp[$row['goods_id']] = array('goods_total' => $row['goods_total']);
        }
        return $temp;
    }


}