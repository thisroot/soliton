<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$dbtype = "mysql"; 
$dbhost = "localhost"; 
$dbname = "soliton"; 
$dbuser = "soliton"; 
$dbpass = "6q0P20pFcb"; 
$dbpath = "c:/test.db";


// switching
switch ($dbtype){ 
case "mysql": $dbconn = "mysql:host=$dbhost;dbname=$dbname"; 
    break; 
case "sqlite": $dbconn = "sqlite:$dbpath"; 
    break; 
case "postgresql": $dbconn = "pgsql:host=$dbhost dbname=$dbname"; 
    break; } // database connection 
    
$pdo = new PDO($dbconn,$dbuser,$dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
?>
