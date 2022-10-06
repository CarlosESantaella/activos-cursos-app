<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/Rule.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/httpstatuscode.php');

    use Model\Rule as RuleModel;
    use Controller\Auth;
    use Controller\HttpStatusCode;

    class Rule {

        public static function create() {

            // Verify permissions
            Auth::has_permission("admin");

            $rule_m = new RuleModel;

            $title = $_POST["title"];
            $description = $_POST["description"];

            $rule_m->create($title, $description);
            HttpStatusCode::response(201, null); return;
        }

    }