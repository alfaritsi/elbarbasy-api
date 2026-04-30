<?php

require_once APPPATH . 'libraries/JWT/JWT.php';
require_once APPPATH . 'libraries/JWT/Key.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generate_token($data) {
    $key = $_ENV['JWT_SECRET'];
    $payload = [
        "iss" => "ci3-api",
        "iat" => time(),
        "exp" => time() + (60 * 60),
        "data" => $data
    ];

    return JWT::encode($payload, $key, 'HS256');
}

function validate_token($token) {
    $key = $_ENV['JWT_SECRET'];
    try {
        return JWT::decode($token, new Key($key, 'HS256'));
    } catch (Exception $e) {
        return false;
    }
}