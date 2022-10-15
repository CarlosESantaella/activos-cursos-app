<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/configuration.php');

    use Controller\Configuration;
    use Controller\Auth;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/app/');
    $dotenv->load();

    if (isset($_COOKIE["access_token"])) {
        $user_global = Auth::me($_COOKIE["access_token"]);
    }

    $configurations = Configuration::get_setups();
    
    include($_SERVER['DOCUMENT_ROOT'].'/app/views/dashboard_view.php');
