<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/9
 * Time: 19:40
 */
defined('HSSH') || exit("Denied access");

class ModelOrderGoods extends Model
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

    // 将购物车中的所有商品写入到数据表中 流程：写入一条 删除一件
    public function writeAllItem($o_id, $o_sn, $u_id) {
        // 获得购物车实例
        $cart = ToolsShoppingCart::GetCart();

        $items = $cart->getItems();
        foreach($items as $k=>$v) {

            // 判断是否写入数据库成功 成功就从购物车中删除该条商品  在调用出检查$cart是否为空即可
            if($this->writeOneItem($o_id, $o_sn, $u_id, $k, $v) == 1) {
                // 从购物车中删除成功插入的商品
                $cart->delItem($k);
            }
        }
    }

    public function writeOneItem($o_id, $o_sn, $u_id, $k, $v) {
        $data = array(
            'order_id' => $o_id,
            'order_sn' => $o_sn,
            'goods_id' => $k,
            'buy_num' => $v['num'],
            'subtotal' => $v['num'] * $v['goods_price'],
            'user_id' => $u_id
        );

        return $this->insert($data);
    }
}

