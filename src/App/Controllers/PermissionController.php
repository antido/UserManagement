<?php

namespace App\Controllers;

require_once __DIR__ . '/../../../vendor/autoloader.php';

use App\Models\Permission;

class PermissionController extends Permission {

	public function getAllData(string $search = ''): array
	{
		$data = $this->getData($search);

		return $data;
	}

	public function insertData(array $data): bool
	{
		$this->store($data);

		return true;
	}

	public function selectData(int $id): array
	{
		$data = $this->select($id);
		
		return $data;
	}

	public function editData(int $id, array $data): bool 
	{
		$this->update($id, $data);
		
		return true;
	}

	public function deleteData(int $id): bool
	{
		$this->delete($id);
		
		return true;
	}

	public function checkData(string $value, int $id = 0): bool
	{
		$data = $this->checkIfExist($value, $id);

		return $data;
	}
}

?>