<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();




    include($_SERVER['DOCUMENT_ROOT'].'/views/home.php');





