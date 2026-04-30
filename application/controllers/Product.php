<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public $Product_model;
    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('upload');
        $this->load->helper(['url', 'security']);
    }

    private function response($success, $message, $data = null, $code = 200) {
        http_response_code($code);
        echo json_encode([
            "success" => $success,
            "message" => $message,
            "data"    => $data
        ]);
        exit;
    }

    /**
     * GET /products
     */
    public function index() {

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return $this->response(false, "Method tidak diizinkan", null, 405);
        }

        $search     = $this->input->get('search', true);
        $page       = (int) $this->input->get('page') ?: 1;
        $limit      = (int) $this->input->get('limit') ?: 10;
        $sort       = $this->input->get('sort') ?: 'desc';
        $min_price  = $this->input->get('min_price');
        $max_price  = $this->input->get('max_price');

        $offset = ($page - 1) * $limit;

        $products = $this->Product_model->getAll($search, $limit, $offset, $sort, $min_price, $max_price);
        $total    = $this->Product_model->countAll($search, $min_price, $max_price);

        foreach ($products as &$p) {
            $p->photo_url = $p->photo
                ? base_url('uploads/products/' . $p->photo)
                : null;
        }

        return $this->response(true, "Berhasil mengambil data", [
            "items" => $products,
            "pagination" => [
                "page" => $page,
                "limit" => $limit,
                "total" => $total,
                "total_page" => ceil($total / $limit)
            ]
        ]);
    }

    /**
     * GET /products/{id}
     */
    public function data($id) {

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return $this->response(false, "Method tidak diizinkan", null, 405);
        }

        $product = $this->Product_model->find($id);

        if (!$product) {
            return $this->response(false, "Produk tidak ditemukanx".$id, null, 404);
        }

        $product->photo_url = $product->photo
            ? base_url('uploads/products/' . $product->photo)
            : null;

        return $this->response(true, "Detail produk", $product);
    }

    /**
     * POST /products
     */
    public function create() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->response(false, "Method tidak diizinkan", null, 405);
        }

        $name  = $this->input->post('name', true);
        $price = $this->input->post('price', true);

        if (!$name || !$price || !is_numeric($price)) {
            return $this->response(false, "Input tidak valid", null, 400);
        }

        $photo = $this->uploadPhoto();

        if (isset($photo['error'])) {
            return $this->response(false, $photo['error'], null, 400);
        }

        $this->Product_model->create([
            "name"  => $name,
            "price" => $price,
            "photo" => $photo
        ]);

        return $this->response(true, "Produk berhasil dibuat", null, 201);
    }

    /**
     * POST /products/{id}
     */
    public function update($id) {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->response(false, "Method tidak diizinkan", null, 405);
        }

        $product = $this->Product_model->find($id);
        if (!$product) {
            return $this->response(false, "Produk tidak ditemukan", null, 404);
        }

        $data = [];

        if ($this->input->post('name')) {
            $data['name'] = $this->input->post('name', true);
        }

        if ($this->input->post('price')) {
            if (!is_numeric($this->input->post('price'))) {
                return $this->response(false, "Price harus angka", null, 400);
            }
            $data['price'] = $this->input->post('price', true);
        }

        if (!empty($_FILES['photo']['name'])) {
            $photo = $this->uploadPhoto();

            if (isset($photo['error'])) {
                return $this->response(false, $photo['error'], null, 400);
            }

            if ($product->photo && file_exists('./uploads/products/' . $product->photo)) {
                unlink('./uploads/products/' . $product->photo);
            }

            $data['photo'] = $photo;
        }

        $this->Product_model->update($id, $data);

        return $this->response(true, "Produk berhasil diperbarui");
    }

    /**
     * DELETE /products/{id}
     */
    public function delete($id) {

        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            return $this->response(false, "Method tidak diizinkan", null, 405);
        }

        $product = $this->Product_model->find($id);
        if (!$product) {
            return $this->response(false, "Produk tidak ditemukan", null, 404);
        }

        if ($product->photo && file_exists('./uploads/products/' . $product->photo)) {
            unlink('./uploads/products/' . $product->photo);
        }

        $this->Product_model->delete($id);

        return $this->response(true, "Produk berhasil dihapus");
    }

    private function uploadPhoto() {

        if (empty($_FILES['photo']['name'])) {
            return null;
        }

        $config = [
            'upload_path'   => './uploads/products/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size'      => 2048,
            'encrypt_name'  => true
        ];

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('photo')) {
            return ["error" => strip_tags($this->upload->display_errors())];
        }

        return $this->upload->data()['file_name'];
    }
}