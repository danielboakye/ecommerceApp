<?php 
require_once(ROOT_PATH . "includes/db.php");
// require_once for stuff lyk functions cos there will b a problem if they load twice

$con = App\DB\connect_to_db($config);

if(!$con){
	die("Could not connect to db!");
}