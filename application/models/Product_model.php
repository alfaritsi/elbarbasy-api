<?php
class Product_model extends CI_Model {

    public function getAll() {
        return $this->db->where('deleted_at', null)->get('products')->result();
    }

    public function create($data) {
        return $this->db->insert('products', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('products', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)
            ->update('products', ['deleted_at' => date('Y-m-d H:i:s')]);
    }
}