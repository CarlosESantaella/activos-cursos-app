<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/auth.php');

    use Controller\Auth;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/app/');
    $dotenv->load();

    Auth::logout();
