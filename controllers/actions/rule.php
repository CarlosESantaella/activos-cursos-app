<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//models/Rule.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/httpstatuscode.php');

    use Model\Rule as RuleModel;
    use Controller\Auth;
    use Controller\HttpStatusCode;

    class Rule {

        public static function get() {

            // Verify permissions
            if (Auth::has_permission("user-client")) {
                $rule_m = new RuleModel;
                $id = $_GET["id"];    
                $rule = $rule_m->get($id);
                HttpStatusCode::response(200, $rule); return;
            }

        }

        public static function get_list($json=false) {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $rule_m = new RuleModel;    
                $list = $rule_m->get_list();
                if ($json) {
                    return $list;
                }else {
                    HttpStatusCode::response(200, $list); return;
                }
            }

        }

        public static function create() {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $rule_m = new RuleModel;
                $title = $_POST["title"];
                $description = $_POST["description"];
                $related_rules = $_POST["related_rules"];
                $rule_m->create($title, $description, $related_rules);
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
                $related_rules = isset($_POST["related_rules"]) ? $_POST["related_rules"]: false;
                if (!$rule_m->get($id_rule)) {
                    HttpStatusCode::raiseException(404, "Rule not found"); return;
                }else {
                    if (!$related_rules) {
                        $rule_temp = $rule_m->get($id_rule);
                        $related_rules = $rule_temp["related_rules"];
                    }
                    $rule_m->update($title, $description, $related_rules, $id_rule);
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
                HttpStatusCode::response(201, null); return;
            }

        }

    }