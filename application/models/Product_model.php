<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    protected $table = 'products';

    public function getAll($search = null, $limit = 10, $offset = 0, $sort = 'desc', $min_price = null, $max_price = null) {

        $this->db->from($this->table);
        $this->db->where('deleted_at IS NULL', null, false);

        if ($search) {
            $this->db->like('name', $search);
        }

        if ($min_price !== null) {
            $this->db->where('price >=', $min_price);
        }

        if ($max_price !== null) {
            $this->db->where('price <=', $max_price);
        }

        $this->db->order_by('id', $sort);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result();
    }

    public function countAll($search = null, $min_price = null, $max_price = null) {

        $this->db->from($this->table);
        $this->db->where('deleted_at IS NULL', null, false);

        if ($search) {
            $this->db->like('name', $search);
        }

        if ($min_price !== null) {
            $this->db->where('price >=', $min_price);
        }

        if ($max_price !== null) {
            $this->db->where('price <=', $max_price);
        }

        return $this->db->count_all_results();
    }

    public function find($id) {
        return $this->db
            ->where('id', $id)
            ->where('deleted_at IS NULL', null, false)
            ->get($this->table)
            ->row();
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db
            ->where('id', $id)
            ->update($this->table, [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
    }
}