<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once "../search.php";

use Controller\Search;

Search::find();