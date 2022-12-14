<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/auth.php');

    use Controller\Auth;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();

    if (isset($_COOKIE["access_token"])) {
        $user_global = Auth::me($_COOKIE["access_token"]);
        if ($user_global) header("location:/");
    }
    
    include($_SERVER['DOCUMENT_ROOT'].'/views/login_view.php');
