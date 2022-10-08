<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/configuration.php');

    use Controller\Configuration;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/app/');
    $dotenv->load();

    $configurations = Configuration::get_setups();
    
    include($_SERVER['DOCUMENT_ROOT'].'/app/views/dashboard_view.php');
