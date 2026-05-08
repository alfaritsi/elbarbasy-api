<?php
class Auth extends CI_Controller {
    public $User_model;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function register() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
            echo json_encode([
                "success" => false,
                "message" => "Input tidak valid.",
                "data" => null
            ]);
            return;
        }

        $existing = $this->User_model->findByEmail($data['email']);
        if ($existing) {
            echo json_encode([
                "success" => false,
                "message" => "Email sudah terdaftar.",
                "data" => null
            ]);
            return;
        }

        $user = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ];

        $this->User_model->create($user);

        echo json_encode([
            "success" => true,
            "message" => "Register success.",
            "data" => null
        ]);
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        $user = $this->User_model->findByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user->password)) {
            echo json_encode([
                "success" => false,
                "message" => "Invalid login.",
                "data" => null
            ]);
            return;
        }

        $token = generate_token([
            "id" => $user->id,
            "email" => $user->email
        ]);

        echo json_encode([
            "success" => true,
            "message" => "Login successful.",
            "data" => $token
        ]);

    }
}