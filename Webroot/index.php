<?php
define("ROOT",$_SERVER['DOCUMENT_ROOT']."/matrimony/");            //define where your app root is
require(ROOT."core/core.php");
$app = new main;
$app->start();
?>