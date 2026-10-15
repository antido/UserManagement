<?php

namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;

class RolePermission extends Database {

	public function checkPermission(int $role_id, string $permission_name): bool
	{
		$sql = "SELECT COUNT(*) FROM role_permissions
                INNER JOIN permissions ON role_permissions.permission_id = permissions.id
                WHERE role_permissions.role_id = :role_id AND permissions.name = :permission_name";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['role_id' => $role_id, 'permission_name' => $permission_name]);

        return $stmt->fetchColumn() > 0;
	}
}

?>