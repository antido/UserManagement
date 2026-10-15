<?php

namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;
use PDOException;
use PDO;

class Role extends Database {

	public function getData(string $search): array
	{
		$sql = "SELECT * FROM roles";

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

		$sql = "INSERT INTO roles ($columns) VALUES ($placeholders)";

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
		$sql = "SELECT * FROM roles WHERE id = :id";

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

		$sql = "UPDATE roles SET $condition WHERE id = :id";

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
		$sql = "DELETE FROM roles WHERE id = :id";

		try {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id' => $id]);

			return true;
		} catch (\PDOException $e) {
			return false;
		}
	}
}

?>