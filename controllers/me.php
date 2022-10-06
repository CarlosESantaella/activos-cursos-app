<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/httpstatuscode.php');
    require_once "auth.php";

    use Controller\Auth;
    use Controller\HttpStatusCode;

    HttpStatusCode::response(200, Auth::me($_POST["access_token"]));
