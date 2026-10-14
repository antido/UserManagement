<?php
namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;
use PDOStatement;

class Auth extends Database {

    public function getData(string $username): PDOStatement
    {
        $query = "SELECT * FROM users WHERE username = :username";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username' => $username]);

        return $stmt;
    }
}

?>