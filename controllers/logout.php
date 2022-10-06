<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/auth.php');

    use Controller\Auth;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();

    Auth::logout();
