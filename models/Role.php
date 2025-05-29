<?php
require_once '../includes/db_connect.php';

class Role {
    private $conn;

    public function __construct() {
        $this->conn = Db_connect::getConnection();
        if ($this->conn === null) {
            throw new Exception('Database connection failed.');
        }
    }

    public function createRole($data) {
        $sql = "INSERT INTO roles (role_name, role_description)
                VALUES (:role_name, :role_description)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':role_name' => $data['role_name'],
            ':role_description' => $data['role_description']
        ]);
    }

    public function getAllRoles() {
        $sql = "SELECT * FROM roles";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoleById($role_id) {
        $sql = "SELECT * FROM roles WHERE role_id = :role_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':role_id' => $role_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRole($role_id, $data) {
        $sql = "UPDATE roles SET
                    role_name = :role_name,
                    role_description = :role_description
                WHERE role_id = :role_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':role_id' => $role_id,
            ':role_name' => $data['role_name'],
            ':role_description' => $data['role_description']
        ]);
    }

    public function deleteRole($role_id) {
        $sql = "DELETE FROM roles WHERE role_id = :role_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':role_id' => $role_id]);
    }
}
