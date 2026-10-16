<?php

namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;
use PDOException;
use PDO;

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

	public function store(int $roleId, array $data): bool
	{
		$deleteSql = "DELETE FROM role_permissions WHERE role_id = :role_id";
		$findSql = "SELECT id FROM permissions WHERE name = :name";
		$insertSql = "INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)";

		try {
			$stmt = $this->conn->prepare($deleteSql);

			$stmt->execute(['role_id' => $roleId]);

			$findPermission = $this->conn->prepare($findSql);
			$insertPermission = $this->conn->prepare($insertSql);

			foreach (array_unique($data) as $permissionName) {
				if (!is_string($permissionName)) {
					return false;
				}

				$findPermission->execute(['name' => $permissionName]);

				$permissionId = $findPermission->fetchColumn();

				if ($permissionId === false) {
					return false;
				}

				$insertPermission->execute([
					'role_id'       => $roleId,
					'permission_id' => $permissionId,
				]);
			}

			return true;

		} catch (PDOException $e) {
			return false;
		}
	}

	public function getRolePermissions(int $roleId): array
	{
		$sql = "SELECT permissions.name FROM role_permissions
				INNER JOIN permissions ON permissions.id = role_permissions.permission_id
				WHERE role_permissions.role_id = :role_id";

		try {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['role_id' => $roleId]);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return [];
		}
	}
}

?>