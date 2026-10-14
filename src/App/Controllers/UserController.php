<?php

namespace App\Controllers;

require_once __DIR__ . '/../../../vendor/autoloader.php';

use App\Models\User;

class UserController extends User {

	public function getAllData()
	{
		$data = $this->getData();

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

	public function getFullNameData(int $id): string
	{
		$data = $this->getFullName($id);

		return $data;
	}
}

?>