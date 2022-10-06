<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/Rule.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/httpstatuscode.php');

    use Model\Rule as RuleModel;
    use Controller\Auth;
    use Controller\HttpStatusCode;

    class Rule {

        public static function get_list() {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $rule_m = new RuleModel;    
                $list = $rule_m->get_list();
                HttpStatusCode::response(200, $list); return;
            }

        }

        public static function create() {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $rule_m = new RuleModel;
    
                $title = $_POST["title"];
                $description = $_POST["description"];
    
                $rule_m->create($title, $description);
                HttpStatusCode::response(201, null); return;
            }

        }

        public static function update() {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $rule_m = new RuleModel;
    
                $id_rule = $_POST["id_rule"];
                $title = $_POST["title"];
                $description = $_POST["description"];

                if (!$rule_m->get($id_rule)) {
                    HttpStatusCode::raiseException(404, "Rule not found"); return;
                }else {
                    $rule_m->update($title, $description, $id_rule);
                    HttpStatusCode::response(201, null); return;
                }

            }

        }

        public static function delete() {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $rule_m = new RuleModel;

                $id_rule = $_POST["id_rule"];

                $rule_m->delete($id_rule);
                HttpStatusCode::response(204, null); return;
            }

        }

    }