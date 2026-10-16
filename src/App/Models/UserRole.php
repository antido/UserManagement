<?php

namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;
use PDOException;
use PDO;

class UserRole extends Database {

	public function assignUserToRole(int $userId, int $roleId): bool
	{
        $findSql = "SELECT id FROM user_roles WHERE user_id = :user_id ";

		try {
            $stmt = $this->conn->prepare($findSql);
            $stmt->execute(['user_id' => $userId]);

            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                $sql = "UPDATE user_roles SET role_id = :role_id WHERE user_id = :user_id";
            } else {
                $sql = "INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)";
            }

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['user_id' => $userId, 'role_id' => $roleId]);

			return true;

		} catch (PDOException $e) {
			return false;
		}
	}

	public function getUserRole(int $userId): array
	{
        $sql = "SELECT user_roles.role_id FROM user_roles
				INNER JOIN users ON users.id = user_roles.user_id
				WHERE user_roles.user_id = :user_id";

		try {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['user_id' => $userId]);

			return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
		} catch (PDOException $e) {
			return [];
		}
	}
}

?>