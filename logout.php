<?php
/*
    Created by : Priyanka Khadilkar
*/
require_once "vendor/autoload.php";

//Initialize the session
$sessionData = Session::getInstance();
$sessionData -> destroy();
header('Location: login.php');