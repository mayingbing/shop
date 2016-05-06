<?php
//入口文件
//引入核心启动类
include "framework/core/Framework.class.php";
// $app = new Framework();
// $app->run();
#Framework::run();
// echo getcwd();
$link = mysql_connect("localhost","root","ma151626");

mysql_query("set names utf8");

mysql_query("use ma_shop_db");

mysql_query("insert into matab(f1,f2) value(123,123);");










#mysqli_close();
#echo"connect successful close";
?>