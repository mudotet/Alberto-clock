<?php
require_once '../includes/db_connect.php';

class Watch {
    private $conn;

    public function __construct() {
        $this->conn = Db_connect::getConnection();
        if ($this->conn === null) {
            throw new Exception('Database connection failed.');
        }
    }

    // CREATE - Thêm đồng hồ mới
    public function createWatch($data) {
        $sql = "INSERT INTO watches (
                    brand_id, model, price, type, description,
                    store_quantity, purchase_date, watches_images
                ) VALUES (
                    :brand_id, :model, :price, :type, :description,
                    :store_quantity, :purchase_date, :watches_images
                )";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':brand_id' => $data['brand_id'],
            ':model' => $data['model'],
            ':price' => $data['price'],
            ':type' => $data['type'],
            ':description' => $data['description'],
            ':store_quantity' => $data['store_quantity'],
            ':purchase_date' => $data['purchase_date'],
            ':watches_images' => $data['watches_images']
        ]);
    }

    // READ - Lấy danh sách tất cả đồng hồ
    public function getAllWatches() {
        $sql = "SELECT * FROM watches";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Lấy thông tin đồng hồ theo ID
    public function getWatchById($watch_id) {
        $sql = "SELECT * FROM watches WHERE watch_id = :watch_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':watch_id' => $watch_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE - Cập nhật thông tin đồng hồ
    public function updateWatch($watch_id, $data) {
        $sql = "UPDATE watches SET
                    brand_id = :brand_id,
                    model = :model,
                    price = :price,
                    type = :type,
                    description = :description,
                    store_quantity = :store_quantity,
                    purchase_date = :purchase_date,
                    watches_images = :watches_images
                WHERE watch_id = :watch_id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':watch_id' => $watch_id,
            ':brand_id' => $data['brand_id'],
            ':model' => $data['model'],
            ':price' => $data['price'],
            ':type' => $data['type'],
            ':description' => $data['description'],
            ':store_quantity' => $data['store_quantity'],
            ':purchase_date' => $data['purchase_date'],
            ':watches_images' => $data['watches_images']
        ]);
    }

    // DELETE - Xóa đồng hồ
    public function deleteWatch($watch_id) {
        $sql = "DELETE FROM watches WHERE watch_id = :watch_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':watch_id' => $watch_id]);
    }

    // BONUS - Lọc theo loại đồng hồ (Luxury, Fashion, v.v.)
    public function getWatchesByType($type) {
        $sql = "SELECT * FROM watches WHERE type = :type";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':type' => $type]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BONUS - Lấy đồng hồ theo hãng
    public function getWatchesByBrand($brand_id) {
        $sql = "SELECT watches.* FROM watches INNER JOIN brands ON watches.brand_id = brands.brand_id WHERE watches.brand_id = :brand_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':brand_id' => $brand_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWatchesByKeyword($keyword) {
        $sql = "SELECT * FROM watches WHERE model LIKE :keyword OR description LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWatchesByPriceRange($min_price, $max_price) {
        $sql = "SELECT * FROM watches WHERE price BETWEEN :min_price AND :max_price";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':min_price' => $min_price, ':max_price' => $max_price]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWatchesByBrandPaginated($brand_id, $limit, $offset) {
        $sql = "SELECT w.*, b.brand_name FROM watches w
                JOIN brands b ON w.brand_id = b.brand_id
                WHERE w.brand_id = :brand_id
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':brand_id', $brand_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countWatchesByBrand($brand_id) {
        $sql = "SELECT COUNT(*) as total FROM watches WHERE brand_id = :brand_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':brand_id' => $brand_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
