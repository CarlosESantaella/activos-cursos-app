<?php

    require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
    require_once "../rule.php";

    use Controller\Rule;

    Rule::delete();
