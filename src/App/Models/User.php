<?php

namespace App\Models;

require_once __DIR__ . '/../../../config/Database.php';

use Database;
use PDOException;
use PDO;

class User extends Database {

	public function getData()
	{
		$sql = "SELECT * FROM users";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function store(array $data): bool
	{
		$columns = implode(', ', array_keys($data));
		$placeholders = ':' . implode(', :', array_keys($data));

		$sql = "INSERT INTO users ($columns) VALUES ($placeholders)";

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
		$sql = "SELECT * FROM users WHERE id = :id";

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

		$sql = "UPDATE users SET $condition WHERE id = :id";

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
		$sql = "DELETE FROM users WHERE id = :id";

		try {
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id' => $id]);

			return true;
		} catch (\PDOException $e) {
			return false;
		}
	}

	public function getFullName(int $id): string
	{
		$sql = "SELECT first_name, middle_name, last_name FROM users WHERE id = :id";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id' => $id]);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!$row) {
			return '';
		}

		return implode(' ', array_filter([
			$row['first_name'],
			$row['middle_name'],
			$row['last_name'],
		], fn($name) => trim($name ?? '') !== ''));
	}
}

?>