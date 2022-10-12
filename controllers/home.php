<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/auth.php');

    use Controller\Auth;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/app/');
    $dotenv->load();

    if (isset($_COOKIE["access_token"])) {
        $user_global = Auth::me($_COOKIE["access_token"]);
        if (!$user_global) header("location:/app/login");
        if ($user_global->type == "admin") header("location:/app/dashboard");
    }else {
        header("location:/app/login");
    }

    include($_SERVER['DOCUMENT_ROOT'].'/app/views/home.php');
