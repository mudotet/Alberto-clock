<?php
require_once '../includes/db_connect.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Db_connect::getConnection();
        if (!$this->conn) {
            throw new Exception('Database connection failed.');
        }
    }

    // CREATE - Thêm người dùng mới
    public function createUser($data) {
        $sql = "INSERT INTO users (email, password, role_id, name, phone_number, address)
                VALUES (:email, :password, :role_id, :name, :phone_number, :address)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role_id' => $data['role_id'],
            ':name' => $data['name'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address']
        ]);
    }

    // READ - Lấy toàn bộ người dùng
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - Lấy người dùng theo ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE - Cập nhật người dùng
    public function updateUser($user_id, $data) {
        $sql = "UPDATE users SET 
                  email = :email,
                  role_id = :role_id,
                  name = :name,
                  phone_number = :phone_number,
                  address = :address
                WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':email' => $data['email'],
            ':role_id' => $data['role_id'],
            ':name' => $data['name'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address'],
            ':user_id' => $user_id
        ]);
    }

    // DELETE - Xóa người dùng
    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':user_id' => $user_id]);
    }

    // AUTH - Kiểm tra đăng nhập
    public function authenticate($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
