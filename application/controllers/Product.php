<?php
class Product extends MY_Controller {
    public $Product_model;

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index() {
        $products = $this->Product_model->getAll();
        if (!$products) {
            http_response_code(404);
            echo json_encode([
                "success" => false,
                "message" => "Data produk tidak ditemukan.",
                "data" => null
            ]);
            return;
        }
        echo json_encode([
            "success" => true,
            "message" => "Berhasil mengambil data produk.",
            "data" => $products
        ]);
    }

    public function create() {
        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input || !isset($input['name']) || !isset($input['price'])) {
            echo json_encode([
                "success" => false,
                "message" => "Input tidak valid.",
                "data" => null
            ]);
            return;
        }

        $this->Product_model->create([
            "name" => $input['name'],
            "price" => $input['price']
        ]);

        echo json_encode([
            "success" => true,
            "message" => "Produk berhasil dibuat.",
            "data" => null
        ]);
    }

    public function update($id) {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            echo json_encode([
                "success" => false,
                "message" => "Input tidak valid.",
                "data" => null
            ]);
            return;
        }

        $updated = $this->Product_model->update($id, $input);

        if (!$updated) {
            echo json_encode([
                "success" => false,
                "message" => "Produk tidak ditemukan.",
                "data" => null
            ]);
            return;
        }

        echo json_encode([
            "success" => true,
            "message" => "Produk berhasil diperbarui.",
            "data" => null
        ]);
    }

    public function delete($id) {
        $deleted = $this->Product_model->delete($id);

        if (!$deleted) {
            echo json_encode([
                "success" => false,
                "message" => "Produk tidak ditemukan.",
                "data" => null
            ]);
            return;
        }

        echo json_encode([
            "success" => true,
            "message" => "Produk berhasil dihapus.",
            "data" => null
        ]);
    }
}