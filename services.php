<?php
require "DB.php";
$list = DB::table('list')->fetchAll();
header('Content-Type: application/json');
echo json_encode($list);
