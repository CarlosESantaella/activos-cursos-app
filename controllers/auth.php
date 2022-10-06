<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/User.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/httpstatuscode.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;
    use Model\User;
    use Controller\HttpStatusCode;

    class Auth {

        public static function auth() {
            global $user_logged;
            if ($user_logged) {
                header("location:/");
            }else {
                require_once("views/auth.php");
            }
        }

        public static function login() {
            $user = new User;
            $username = $_POST["username"];
            $password = $_POST["password"];

            $user_found = $user->get_user_by_username($username);
            if (!$user_found) {
                HttpStatusCode::raiseException(401, "User not found");
                return;
            }
            if ($user_found["password"] == strval($password)) {
                $access_token = Auth::generate_access_token($user_found);
                setcookie("access_token", $access_token, 0, '/');
                $response = ['access_token' => Auth::generate_access_token($user_found), 'user' => $user_found];
                HttpStatusCode::response(200, $response); return;
            }else {
                HttpStatusCode::raiseException(401, "Incorrect password"); return;
            }
        }

        public static function logout() {
            setcookie("access_token", false, -1, '/');
            header('location: /');
        }

        public static function me($access_token) {
            $jwt = Auth::decode_access_token($access_token);
            return $jwt;
        }

        public static function generate_access_token($data) {
            $created = date("Y-m-d H:i:s");
            $data['iat'] = strtotime($created);
            $data['exp'] = strtotime(TOKEN_EXPIRATION_TIME ,strtotime($created));
            $perms = stripslashes(html_entity_decode($data['permissions']));
            $data['permissions'] = json_decode($perms,true);
            unset($data['password']);
            return JWT::encode($data, CLIENT_SECRET, JWT_ALGORITHM);
        }
        
        public static function decode_access_token($access_token) {
            try {
                return JWT::decode($access_token, new Key(CLIENT_SECRET, JWT_ALGORITHM));
            } catch (\Throwable $th) {
                setcookie("access_token", false, -1, '/');
                return false;
            }
        }

    }