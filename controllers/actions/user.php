<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//models/User.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/httpstatuscode.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//models/Configuration.php');

    use Model\User as UserModel;
    use Model\Configuration;
    use Controller\HttpStatusCode;

    class User {

        public static function create() {
            $user = new UserModel;
            $configuration = new Configuration;

            $full_name = $_POST["full_name"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            $user_found = $user->get_user_by_username($username);
            if ($user_found) {
                HttpStatusCode::raiseException(409, "Username already registered"); return;
            }
            $conf = $configuration->get_setups();
            $user->create($full_name, $username, $password, $conf["user_limit"]);
            HttpStatusCode::response(201, null); return;
        }

    }