# ecshop
ECSHOP SQL语句调试插件

使用方法:
1.开启调试模式：修改data/config.php文件中的DEBUG_MODE常量为15：
    define('DEBUG_MODE', 15);
2.将本文件（cls_debug_sql.php）放入web/includes文件夹下
3.在web/includes/init.php文件倒数第二行加入：
    require_once(ROOT_PATH . 'includes/cls_debug_sql.php');
    $debug_sql = new debug_sql($db);
4.在需要查看SQL的页面最后输出的时候（一般是在$smarty->display();语句后面）加入：
	$GLOBALS['debug_sql']->show();
