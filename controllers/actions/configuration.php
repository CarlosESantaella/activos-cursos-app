<?php
    namespace Controller;

    require_once($_SERVER['DOCUMENT_ROOT'].'/models/Configuration.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/auth.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/actions/httpstatuscode.php');

    use Model\Configuration as ConfigurationModel;
    use Controller\Auth;
    use Controller\HttpStatusCode;

    class Configuration {

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