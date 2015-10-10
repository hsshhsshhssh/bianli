<?php 

/**
file: index.php
功能: 首页
**/
define("HSSH", true);

header('location: http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) . '/front/index.php');

 ?>