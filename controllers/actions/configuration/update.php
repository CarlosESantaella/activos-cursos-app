<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once "../configuration.php";

    use Controller\Configuration;

    Configuration::update();
