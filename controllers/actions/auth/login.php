<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
    require_once "../auth.php";

    use Controller\Auth;

    Auth::login();
