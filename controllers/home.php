<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/app/vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app/controllers/actions/user.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app/controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app/controllers/actions/configuration.php');

    use Controller\Configuration;
    use Controller\Auth;
    use Controller\User;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/app/');
    $dotenv->load();
    
    if (isset($_COOKIE["access_token"])) {
        $user_global = Auth::me($_COOKIE["access_token"]);
        $configurations = Configuration::get_setups();
        if (!$user_global) header("location:/app/login");
        if ($user_global->type == "admin") header("location:/app/dashboard");
        $user_data = User::get_user_by_username($user_global->user);
        $query_limit = $user_data["query_limit"];
    }else {
        header("location:/app/login");
    }

    include($_SERVER['DOCUMENT_ROOT'].'/app/views/home.php');
