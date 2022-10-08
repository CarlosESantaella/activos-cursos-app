<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once "../user.php";

    use Controller\User;

    User::create();
