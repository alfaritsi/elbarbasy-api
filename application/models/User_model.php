<?php
class User_model extends CI_Model {

    public function create($data) {
        return $this->db->insert('users', $data);
    }

    public function findByEmail($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
}