<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/User.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/httpstatuscode.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;
    use Model\User;
    use Controller\HttpStatusCode;

    class Auth {

        public static function login() {
            $user = new User;
            $username = $_POST["username"];
            $password = $_POST["password"];

            $user_found = $user->get_user_by_username($username);
            if (!$user_found) {
                HttpStatusCode::raiseException(401, "Wrong username or password"); return;
            }
            if ($user_found["password"] == strval($password)) {
                $access_token = Auth::generate_access_token($user_found);
                setcookie("access_token", $access_token, 0, '/');
                $response = [
                    'access_token' => Auth::generate_access_token($user_found),
                    'type' => $user_found["type"]
                ];
                HttpStatusCode::response(200, $response); return;
            }else {
                HttpStatusCode::raiseException(401, "Wrong username or password"); return;
            }
        }

        public static function logout() {
            setcookie("access_token", false, -1, '/');
            header('location: /login');
        }

        public static function me($access_token) {
            $jwt = Auth::decode_access_token($access_token);
            return $jwt;
        }

        public static function generate_access_token($data) {
            $created = date("Y-m-d H:i:s");
            $data['iat'] = strtotime($created);
            $data['exp'] = strtotime(TOKEN_EXPIRATION_TIME ,strtotime($created));
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

        public static function has_permission($permission) {
            if (isset($_SERVER["HTTP_AUTHORIZATION"]) || isset($_COOKIE["access_token"])) {
                $access_token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : $_COOKIE["access_token"];
                $token =  isset($_SERVER["HTTP_AUTHORIZATION"]) ? explode(" ", $access_token)[1] : $access_token;
                $me = Auth::me($token);
                 if ($me) {
                    if ($permission == "user-client") {
                        if ($me->type == "user" || $me->type == "client" ) {
                            return True;
                        }
                    }else {
                        if ($me->type == $permission) {
                            return True;
                        }
                    }
                }
            }
            HttpStatusCode::raiseException(401, "You do not have permissions"); return;
        }

    }