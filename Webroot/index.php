<?php
use Core\main;
require("../core/Core.php");
$app = new main;
$app->start();
echo xdebug_get_profiler_filename();

?>