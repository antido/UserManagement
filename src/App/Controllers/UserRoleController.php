<?php

namespace App\Controllers;

require_once __DIR__ . '/../../../vendor/autoloader.php';

use App\Models\UserRole;

class UserRoleController extends UserRole {

	public function assignData(int $userId, int $roleId): bool
	{
		$this->assignUserToRole($userId, $roleId);

		return true;
	}

	public function getData(int $userId): array
	{
		$data = $this->getUserRole($userId);
		
		return $data;
	}

	public function checkRole(int $userId): bool
	{
		$data = $this->checkIsSuperAdmin($userId);
		
		return $data;
	}
}

?>