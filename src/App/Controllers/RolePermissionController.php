<?php

namespace App\Controllers;

require_once __DIR__ . '/../../../vendor/autoloader.php';

use App\Models\RolePermission;

class RolePermissionController extends RolePermission {

	public function checkHasPermission(int $role_id, string $permission_name): bool
	{
		$data = $this->checkPermission($role_id, $permission_name);

		return $data;
	}
}

?>