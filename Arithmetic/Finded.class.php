<?php
/**
 * 关于查找算法的PHP实现
 * 顺序查找、二分(折半)查找
 *
 * @author hkf <876946649@qq.com>
 * @version 0.1.0
 */
class Finded
{
    /**
     * @var object $_instance 类的实例
     */
    private static $_instance = NULL;

    /**
     * Class construct
     */
    private function __construct() {}

    /**
     * 获取类的实例(单例模式)
     *
     * @return null|Sorted
     */
    public static function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new Finded();
        }
        return self::$_instance;
    }

    /**
     *
     * 二分法查找也称折半查找，其优点是查找速度快，缺点是要求所查找的数据必须是有序序列。
     * 该算法的基本思想是将所要查找的序列的中间位置与所要查找的元素进行比较，如果相等则
     * 表示查找成功，否则将以该位置为基准将所要查找的序列分为左右两部分。然后来选择所要
     * 查找的元素可能存在的那部分序列，对其采用同样的方法进行查找，直至确定所要查找的元
     * 素是否存在。
     *
     * @param array $arr
     * @param int $search_val
     * @return mixed
     */
    public function half_search($arr, $search_val)
    {
        $low = 0;
        $high = count($arr) - 1;
        while ($low <= $high) {
            $mid = ceil(($low + $high) / 2);
            $mid_val = $arr[$mid];
            if($mid_val < $search_val) {
                $low = $mid + 1;
            }elseif($mid_val > $search_val) {
                $high = $mid - 1;
            }else {
                return $mid_val;
            }
        }
    }

    /**
     * 设置浏览器的响应内容
     */
    public function response()
    {
        //  禁用缓存
        header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
        header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
        header( 'Cache-Control: no-store, no-cache, must-revalidate' );
        header( 'Cache-Control: post-check=0, pre-check=0', false );
        header( 'Pragma: no-cache' );
        //  声明响应类型
        header( 'Content-Type:text/html;charset=utf-8');
    }
}