<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/configuration.php');

    use Controller\Configuration;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
    $dotenv->load();

    $configurations = Configuration::get_setups();
    
    include($_SERVER['DOCUMENT_ROOT'].'/views/dashboard_view.php');
