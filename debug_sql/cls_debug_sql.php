<?php
/**
 * ECSHOP SQL语句调试插件
 *
 * @Author: yangguanghui
 * @Email: 252699464@qq.com
 * @Date: 2016-01-21
 * @version: V1.0
 *
 * 使用方法:
 * 1.开启调试模式：修改data/config.php文件中的DEBUG_MODE常量为15：
 *      define('DEBUG_MODE', 15);
 * 2.将本文件（cls_debug_sql.php）放入web/includes文件夹下
 * 3.在web/includes/init.php文件倒数第二行加入：
 *      require_once(ROOT_PATH . 'includes/cls_debug_sql.php');
 *      $debug_sql = new debug_sql($db);
 * 4.在需要查看SQL的页面最后输出的时候（一般是在$smarty->display();语句后面）加入：
 *  	$GLOBALS['debug_sql']->show();
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

class debug_sql
{
    var $begin = false;
    var $logfilename = '';
    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    function __construct($db)
    {
        $this->debug_sql($db);
    }

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    function debug_sql($db)
    {
        if($db){
            $this->logfilename = $db->root_path . DATA_DIR . '/mysql_query_' . $db->dbhash . '_' . date('Y_m_d') . '.log';
            $this->begin = filesize($this->logfilename);
        }
    }

    /**
     * 显示每个页面执行的SQL语句
     *
     * @access  public
     * @return  void
     */
    function show($mode = 2)
    {
        clearstatcache(true,$this->logfilename);
        if(filesize($this->logfilename) > $this->begin){
            $fp = fopen($this->logfilename , 'r');
            fseek($fp, $this->begin);
            $contents = array();
            while(($str = fgets($fp)) !== false){
                $contents[] = $str;
            }
            print_a($contents,$mode,true);
        }
    }
}

?>