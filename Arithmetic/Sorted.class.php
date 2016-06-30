<?php
/**
 * 关于排序算法的php实现
 * 冒泡排序、选择排序、插入排序、快速排序
 *
 * @author hkf <876946649@qq.com>
 * @version 0.1.0
 */

class Sorted
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
            self::$_instance = new Sorted();
        }
        return self::$_instance;
    }

    /**
     * 冒泡排序算法
     * 在要排序的一组数中，对当前还未排好的序列，从前往后对相邻的两个数依次进行比较和调整，
     * 让较大的数往下沉，较小的往上冒。
     *
     * @param array $arr 未进行排序的数组
     * @return array $arr 排序后的数组
     */
    public function bubbleSort($arr)
    {
        if (!is_array($arr)) {
            die('请传入一个数组');
        }
        $length = count($arr);
        //  该层用于控制外层的循环
        for ($i = 0 ; $i < ($length - 1) ; $i++) {
            //  该层用于控制内层的循环,每轮冒出一个数
            for ($j = 0; $j < ($length - 1); $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $tmp;
                }
            }
        }
        return $arr;
    }

    /**
     * 选择排序算法
     * 在要排序的一组数中，选出最小的一个数与第一个位置的数交换。
     * 然后在剩下的数当中再找最小的与第二个位置的数交换，如此循环到倒数第二个数和最后一个数比较为止
     *
     * @param array $arr 待排序的数组
     * @return array $arr 排序之后的数组
     */
    public function selectSoft($arr)
    {
        //  双重循环完成,外层控制轮数,内层控制比较次数
        $len = count($arr);
        for($i = 0; $i < $len - 1; $i++) {
            //  先假设最小的值的位置
            $p = $i;
            for($j = $i + 1; $j < $len; $j++) {
                if($arr[$p] > $arr[$j]) {
                    //  比较,发现更小的,记录下最小值的位置;并且在下次比较时采用已知的最小值进行比较。
                    $p = $j;
                }
            }
            /**
             * 已经确定了当前的最小值的位置，保存到$p中。
             * 如果发现最小值的位置与当前假设的位置$i不同，则位置互换即可。
             */
            if($p != $i) {
                $tmp = $arr[$p];
                $arr[$p] = $arr[$i];
                $arr[$i] = $tmp;
            }
        }
        return $arr;
    }

    /**
     * 插入排序
     * 在要排序的一组数中,假设前面的数已经是排好顺序的,现在要把第n个数插到前面的有序数中,使得这n个数也是排好顺序的。
     * 如此反复循环，直到全部排好顺序。
     *
     * @param array $arr 待排序的数组
     * @return array $arr 排序之后的数组
     */
    public function insertSoft($arr)
    {
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {
            $tmp = $arr[$i];
            //  内层循环控制,比较并插入.
            for($j = $i - 1; $j >= 0; $j--) {
                if($tmp < $arr[$j]) {
                    //  发现插入的元素要小,交换位置,将后边的元素与前面的元素互换.
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $tmp;
                } else {
                    //  如果碰到不需要移动的元素,由于是已经排序好是数组,则前面的就不需要再次比较了.
                    break;
                }
            }
        }
        return $arr;
    }

    /**
     * 快速排序
     * 选择一个基准元素，通常选择第一个元素或者最后一个元素。
     * 通过一趟扫描，将待排序列分成两部分，一部分比基准元素小，一部分大于等于基准元素。
     * 此时基准元素在其排好序后的正确位置，然后再用同样的方法递归地排序划分的两部分。
     *
     * @param array $arr 排序之前的数组
     * @return array $arr 排序之后的数组
     */
    public function quickSort($arr)
    {
        //  先判断是否需要继续进行
        $length = count($arr);
        if ($length <= 1) {
            return $arr;
        }
        //  选择第一个元素作为基准
        $base_num = $arr[0];
        //  遍历除了标尺外的所有元素，按照大小关系放入两个数组内
        //  初始化两个数组
        $left_array = array();  //小于基准的
        $right_array = array();  //大于基准的
        for ($i = 1; $i < $length; $i++) {
            if($base_num > $arr[$i]) {
                // 放入左边数组
                $left_array[] = $arr[$i];
            } else {
                // 放入右边
                $right_array[] = $arr[$i];
            }
        }
        //  再分别对左边和右边的数组进行相同的排序处理方式递归调用这个函数
        $left_array = $this->quickSort($left_array);
        $right_array = $this->quickSort($right_array);
        //  合并
        return array_merge($left_array, array($base_num), $right_array);
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

$arr =
    [
        1, 43, 54, 62, 21,
        66, 32, 78, 36, 76, 39
    ];
$sorted = Sorted::getInstance();
$sorted->response();
echo "排序之前的数组：<br/>";
print_r($arr);
echo "<br/>排序之后的数组(冒泡排序:从小到大)：<br/>";
print_r($sorted->bubbleSort($arr));
echo "<br/>排序之后的数组(选择排序:从小到大)：<br/>";
print_r($sorted->selectSoft($arr));
echo "<br/>排序之后的数组(插入排序:从小到大)：<br/>";
print_r($sorted->insertSoft($arr));
echo "<br/>排序之后的数组(快速排序:从小到大)：<br/>";
print_r($sorted->quickSort($arr));
