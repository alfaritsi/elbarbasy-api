<?php
class MY_Controller extends CI_Controller {

    protected $user;

    public function __construct() {
        parent::__construct();

        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            $this->responseUnauthorized();
        }

        $token = str_replace("Bearer ", "", $headers['Authorization']);
        $decoded = validate_token($token);

        if (!$decoded) {
            $this->responseUnauthorized();
        }

        $this->user = $decoded->data;
    }

    private function responseUnauthorized() {
        echo json_encode(["message" => "Unauthorized"]);
        exit;
    }
}