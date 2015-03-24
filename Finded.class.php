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

    public function sequenceSearch()
    {
        
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