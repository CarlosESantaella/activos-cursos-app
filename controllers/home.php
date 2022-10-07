<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();

    if (isset($_COOKIE["access_token"])) {
        $user_global = Auth::me($_COOKIE["access_token"]);
        if (!$user_global) header("location:/login");
    }else {
        header("location:/login");
    }

    include($_SERVER['DOCUMENT_ROOT'].'/views/home.php');
