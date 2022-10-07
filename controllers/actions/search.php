<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/Rule.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/User.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/httpstatuscode.php');

    use Model\Rule;
    use Model\User;
    use Controller\Auth;
    use Controller\HttpStatusCode;

    class Search {

        public static function find() {

            // Verify permissions
            if (Auth::has_permission("user-client")) {
                $rule_m = new Rule;
                $user_m = new User;

                // Get key
                $search = $_POST["search"];

                // Get data of user
                $access_token = isset($_SERVER["HTTP_AUTHORIZATION"]) ? $_SERVER["HTTP_AUTHORIZATION"] : $_COOKIE["access_token"];
                $user = Auth::me($access_token);
                $user = $user_m->get_user_by_username($user->user);
                if ($user["query_limit"] == 0) {
                    HttpStatusCode::raiseException(401, "User exceeded query limit"); return;
                }

                //$user["created_at"]
                $today = new \DateTime();
                $expires = new \DateTime($user["expires_at"]);
                $interval = $today->diff($expires);
                if (intval($interval->format("%r%a")) <= 0) {
                    HttpStatusCode::raiseException(401, "User trial time expired"); return;
                }

                // Verify access by time or limits
                $list = $rule_m->get_list_by_filter($search);

                // Decrease limit
                if ($user["type"] == "user") {
                    $user_m->decrease_limit($user["query_limit"], $user["id"]);
                }

                HttpStatusCode::response(200, $list); return;
            }

        }

    }