<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/app//models/Configuration.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/app//controllers/actions/httpstatuscode.php');

    use Model\Configuration as ConfigurationModel;
    use Controller\Auth;
    use Controller\HttpStatusCode;

    class Configuration {

        public static function get_setups() {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $configuration_m = new ConfigurationModel;
                $configurations = $configuration_m->get_setups();
                return $configurations;
            }

        }

        public static function update() {

            // Verify permissions
            if (Auth::has_permission("admin")) {
                $configuration_m = new ConfigurationModel;
                $limit_user = $_POST["limit_user"];
                $configuration_m->update($limit_user);
                HttpStatusCode::response(201, null); return;
            }

        }

    }