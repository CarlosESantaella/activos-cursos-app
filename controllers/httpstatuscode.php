<?php

    namespace Controller;

    class HttpStatusCode {

        public static function setHeader($status_code) {
            header('content-type: application/json; charset=utf-8');
            switch ($status_code) {
                case '200':
                    header('HTTP/1.0 200 Ok');
                    break;
                case '201':
                    header('HTTP/1.0 201 Created');
                    break;
                case '204':
                    header('HTTP/1.0 204 No Content');
                    break;
                case '401':
                    header('HTTP/1.0 401 Unauthorized');
                    break;
                case '404':
                    header('HTTP/1.0 404 Not Found');
                    break;
                case '409':
                    header('HTTP/1.0 409 Conflict');
                    break;
                case '500':
                    header('HTTP/1.0 500 Internal Server Error');
                    break;
            }
        }

        public static function raiseException($status_code, $message) {
            HttpStatusCode::setHeader($status_code);
            echo json_encode([
                "details"=>$message
            ]);
        }

        public static function response($status_code, $data) {
            HttpStatusCode::setHeader($status_code);
            echo json_encode($data);
        }

    }