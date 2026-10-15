<?php
namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;
use PDOStatement;

class Auth extends Database {

    public function getData(string $username): PDOStatement
    {
        $query = "SELECT users.*, user_roles.role_id FROM users 
                LEFT JOIN user_roles ON users.id = user_roles.user_id
                WHERE username = :username";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username' => $username]);

        return $stmt;
    }
}

?>