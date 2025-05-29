<?php
require_once '../includes/db_connect.php';

class Brand {
    private $conn;

    public function __construct() {
        $this->conn = Db_connect::getConnection();
        if ($this->conn === null) {
            throw new Exception('Database connection failed.');
        }
    }

    // CREATE - Thêm thương hiệu mới
    public function createBrand($data) {
        $sql = "INSERT INTO brands (brand_name, brand_description, stock_quantity, brands_images)
                VALUES (:brand_name, :brand_description, :stock_quantity, :brands_images)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':brand_name' => $data['brand_name'],
            ':brand_description' => $data['brand_description'],
            ':stock_quantity' => $data['stock_quantity'],
            ':brands_images' => $data['brands_images']
        ]);
    }

    // READ - Lấy tất cả thương hiệu
    public function getAllBrands() {
        $sql = "SELECT * FROM brands";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Lấy thương hiệu theo ID
    public function getBrandById($brand_id) {
        $sql = "SELECT * FROM brands WHERE brand_id = :brand_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':brand_id' => $brand_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE - Cập nhật thương hiệu
    public function updateBrand($brand_id, $data) {
        $sql = "UPDATE brands SET
                    brand_name = :brand_name,
                    brand_description = :brand_description,
                    stock_quantity = :stock_quantity,
                    brands_images = :brands_images
                WHERE brand_id = :brand_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':brand_id' => $brand_id,
            ':brand_name' => $data['brand_name'],
            ':brand_description' => $data['brand_description'],
            ':stock_quantity' => $data['stock_quantity'],
            ':brands_images' => $data['brands_images']
        ]);
    }

    // DELETE - Xóa thương hiệu
    public function deleteBrand($brand_id) {
        $sql = "DELETE FROM brands WHERE brand_id = :brand_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':brand_id' => $brand_id]);
    }
}
