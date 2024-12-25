<?php

$serverName = "LAPTOP-HCF35NMJ\SQLEXPRESS";
$connectionOptions = array(
    "Database" => "SIPRESMA",
    "Uid" => "sa",
    "PWD" => "siwof"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

return $conn;
