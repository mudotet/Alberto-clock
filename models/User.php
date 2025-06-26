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

    public function createUser($data) {
        $sql = "INSERT INTO users (email, password, role_id, name, phone_number, address, registration_date)
                VALUES (:email, :password, :role_id, :name, :phone_number, :address, :registration_date)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role_id' => $data['role_id'],
            ':name' => $data['name'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address'],
            ':registration_date' => $data['registration_date']
        ]);
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($user_id, $data) {
        $sql = "UPDATE users SET
                  email = :email,
                  role_id = :role_id,
                  name = :name,
                  phone_number = :phone_number,
                  address = :address";

        // Thêm trường password vào câu lệnh SQL nếu có password mới được cung cấp
        if (isset($data['password']) && !empty($data['password'])) {
            $sql .= ", password = :password";
        }
        $sql .= " WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($sql);

        $params = [
            ':email' => $data['email'],
            ':role_id' => $data['role_id'],
            ':name' => $data['name'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address'],
            ':user_id' => $user_id
        ];

        // Hash mật khẩu mới trước khi thêm vào params
        if (isset($data['password']) && !empty($data['password'])) {
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $stmt->execute($params);
    }

    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':user_id' => $user_id]);
    }

    public function authenticate($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // So sánh mật khẩu đã được hash
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}