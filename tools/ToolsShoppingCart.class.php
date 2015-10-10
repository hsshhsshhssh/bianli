<?php
/**
 * Created by PhpStorm.
 * User: hssh_win8.1
 * Date: 2015/10/8
 * Time: 19:46
 * 购物车类
 * 实现要求：session+单例
 * 功能分析：
判断某个商品是否存在
添加商品
删除商品
修改商品的数量

某商品数量加1
某商品数量减1

查询购物车的商品种类
查询购物车的商品数量
查询购物车里的商品总金额
返回购物里的所有商品

清空购物车
 */
require_once('../model/ModelGoods.class.php');

Class ToolsShoppingCart {

    private static $_ins = null;
    private $items = array();   //购物车里面的商品
    protected $rand;

    final protected function __construct() {
        $this->rand = mt_rand(1000,99999999);
    }
    public function show() {
        echo $this->rand;
    }
    final protected function __clone() {}

    // 单例
    protected static function getIns() {
        if((!(self::$_ins instanceof self))) {
            self::$_ins = new self();
        }
        return self::$_ins;
    }

    // 放入session中
    public static function GetCart () {

        if(!isset($_SESSION['cart']) || ! ($_SESSION['cart'] instanceof self)) {
            $_SESSION['cart'] = self::getIns();
        }
        return $_SESSION['cart'];
    }


    //判断某个商品是否存在
    public function isEexit($goods_id) {
        return array_key_exists($goods_id, $this->items);
    }


    //添加商品 goods_id goods_name goods_price(一件) goods_num=1
    public function addItem($goodsinfo, $goods_num=1) {
        // 已存在的商品 直接修改数量
        if($this->isEexit($goodsinfo['goods_id'])) {
            $this->modNum($goodsinfo['goods_id'],$goods_num);
            return;
        }

        // 不存在的话 新创建一个
//        $temp = array();
        $temp['goods_name'] = $goodsinfo['goods_name'];
        $temp['goods_price'] = $goodsinfo['goods_price'];
        $temp['num'] = $goods_num;
        $temp['goods_img'] = $goodsinfo['goods_img'];

        // 以goods_id为索引
        $this->items[$goodsinfo['goods_id']] = $temp;
    }

    //修改商品的数量
    public function modNum($goods_id, $goods_num) {
        // 先判断是否存在
        if(!$this->isEexit($goods_id)) {
            return ;
        }

        // 判断num
        if($goods_num <= 1) {
            $goods_num = 1;
        }

        // 获得商品的库存量
        $mg = new ModelGoods('bl_goods');
        $total = $mg->getOne("select goods_total from bl_goods where goods_id=" . $goods_id);
        if($goods_num >= $total) {
            $goods_num = $total;
        }

        $this->items[$goods_id]['num'] = $goods_num;

    }

    //删除商品
    public function delItem($goods_id) {
        unset($this->items[$goods_id]);  // goods_id 不存在也不会报错
    }

    //某商品数量加1 保持数据的唯一性 修改数据只使用modNum
    public function incOne($goods_id) {
        $this->modNum($goods_id, $this->getNum($goods_id) + 1);
    }

    //某商品数量减1
    public function decOne($goods_id) {
        $this->modNum($goods_id, $this->getNum($goods_id) - 1);
    }


    // 查询购物车的某件商品的数量
    public function getNum($goods_id) {
        if($this->items[$goods_id]) {
            return $this->items[$goods_id]['num'];
        }
        else return 0;
    }

    //查询购物车的商品种类
    public function getAllKinds() {
        return count($this->items);
    }

    //返回购物车里商品的总件数
    public function getTotalNum() {
        $num = 0;
        foreach($this->items as $v) {
            $num += $v['num'];
        }
        return $num;
    }


    //查询购物车里的商品总金额
    public function getTotalPrice() {

        $sum = 0.0;
        foreach($this->items as $k=>$v) {
            $sum += $v['goods_price'] * $v['num'];
        }

        return $sum;

    }

    // 清空购物车
    public function clear() {
        $this->items = array();
    }

    // 返回购物车的所有商品信息
    public function getItems() {
        return $this->items;
    }

    // 判断购物车是否为空
    public  function isEmpty() {
        return empty($this->items);
    }

    public function cartMerge($items) {
        foreach($items as $k=>$v) {
            $this->addItem(array(
                "goods_id" => $k,
                "goods_name" => $v['goods_name'],
                "goods_price" => $v['goods_price'],
                "goods_img" => $v['goods_img']),
                $v['num']);
        }
    }
}


