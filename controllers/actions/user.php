<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//models/User.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/httpstatuscode.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//models/Configuration.php');

    use Model\User as UserModel;
    use Model\Configuration;
    use Controller\HttpStatusCode;

    class User {

        public static function get_user_by_username($username) {
            $user = new UserModel;
            return $user->get_user_by_username($username);
        }

        public static function create() {
            $user = new UserModel;
            $configuration = new Configuration;

            $full_name = $_POST["full_name"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $limit_query = $_POST["limit_query"];
            $expires_at = $_POST["expires_at"];

            $user_found = $user->get_user_by_username($username);
            if ($user_found) {
                HttpStatusCode::raiseException(409, "Username already registered"); return;
            }
            $user->create($full_name, $username, $password, $limit_query, $email, $phone, $expires_at);
            HttpStatusCode::response(201, null); return;
        }

    }