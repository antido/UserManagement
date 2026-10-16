<?php

namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;
use PDOException;
use PDO;

class Permission extends Database {

	public function getData(string $search): array
	{
		$sql = "SELECT * FROM permissions";

		if (!empty(trim($search))) {
			$sql .= " WHERE name LIKE :search";
		}

		$stmt = $this->conn->prepare($sql);

		if (!empty(trim($search))) {
			$stmt->bindValue(':search', '%' . trim($search) . '%', PDO::PARAM_STR);
		}

		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function store(array $data): bool
	{
		$columns = implode(', ', array_keys($data));
		$placeholders = ':' . implode(', :', array_keys($data));

		$sql = "INSERT INTO permissions ($columns) VALUES ($placeholders)";

		try {
			$stmt = $this->conn->prepare($sql);

			$stmt->execute($data);

			return true;

		} catch (PDOException $e) {
			return false;
		}
	}

	public function select(int $id): array
	{
		$sql = "SELECT * FROM permissions WHERE id = :id";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row;
	}

	public function update(int $id, array $data): bool
	{
		$set = [];
		foreach ($data as $key => $value) {
			$set[] = "`$key` = :$key";
		}

		$condition = implode(', ', $set);

		$sql = "UPDATE permissions SET $condition WHERE id = :id";

		try {
			$stmt = $this->conn->prepare($sql);

			$data['id'] = $id;

			$stmt->execute($data);

			return true;

		} catch (\PDOException $e) {
			return false;
		}
	}

	public function delete(int $id): bool
	{
		$sql = "DELETE FROM permissions WHERE id = :id";

		try {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id' => $id]);

			return true;
		} catch (\PDOException $e) {
			return false;
		}
	}

	public function checkIfExist(string $value, int $id): bool
	{
		$sql = "SELECT COUNT(*) FROM permissions WHERE name = :permission_name AND id != :permission_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['permission_name' => $value, 'permission_id' => $id]);

		return $stmt->fetchColumn() > 0;
	}
}

?>