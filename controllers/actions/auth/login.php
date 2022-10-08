<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once "../auth.php";

    use Controller\Auth;

    try {
    
        Auth::login();
    } catch (\Throwable $th) {
        echo $th;
    }
