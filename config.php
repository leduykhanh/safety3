<?php

/**********************************************************************
 *Contains all the basic Configuration
 *dbHost = Host of your MySQL DataBase Server... Usually it is localhost
 *dbUser = Username of your DataBase
 *dbPass = Password of your DataBase
 *dbName = Name of your DataBase
 **********************************************************************/
$dbHost = 'localhost';
$dbUser = 'rocketiv_risk';
$dbPass = 'admin@123';
$dbName = 'rocketiv_riskmanagement';
$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)
        or die('Error Connecting to MySQL DataBase');

date_default_timezone_set('Europe/Bucharest')        
?>