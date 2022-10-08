<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/auth.php');

    use Controller\Auth;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/app/');
    $dotenv->load();

    if (isset($_COOKIE["access_token"])) {
        $user_global = Auth::me($_COOKIE["access_token"]);
        if ($user_global) header("location:/app/");
    }

    include($_SERVER['DOCUMENT_ROOT'].'/app/views/register_view.php');
