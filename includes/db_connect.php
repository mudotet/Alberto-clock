<?php 
class Db_connect {
    public static function getConnection() {
        $host = "localhost";
        $db_name = "aberto_clock";
        $username = "root";
        $password = "";
        $conn = null;
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $conn; // ✅ Quan trọng!
    }
}
?>
