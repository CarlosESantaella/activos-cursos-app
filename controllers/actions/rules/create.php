<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//vendor/autoload.php');
    require_once "../rule.php";

    use Controller\Rule;

    Rule::create();
