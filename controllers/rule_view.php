<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/app/vendor/autoload.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app/models/Rule.php');

    use Model\Rule;

    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'].'/app/');
    $dotenv->load();

    $rule_m = new Rule;
    $id = $_GET["id"];    
    $rule = $rule_m->get($id);

    $related_rules = [];
    $related_rules_ids = explode(',', $rule["related_rules"]);

    foreach ($related_rules_ids as $key => $id_rule) {
        if ($id_rule) {
            $temp = $rule_m->get($id_rule);
            $related_rules[$id_rule] = $temp["title"];
        }
    }

    include($_SERVER['DOCUMENT_ROOT'].'/app/views/rule_view.php');
