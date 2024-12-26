<?php

$serverName = "LAPTOP-CACRPO0M\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "PBLSIPRESMA",
    "Uid" => "",
    "PWD" => ""

);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

return $conn;
