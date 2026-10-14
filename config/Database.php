<?php

class Database {

	public PDO $conn;

	public function __construct()
	{
		try {
			$this->conn = new PDO(
				"mysql:host=127.0.0.1;port=21000;dbname=user_management;charset=utf8mb4",
				"root",
				"antido@2024;"
			);

			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			die("Connection error: " . $e->getMessage());
		}
	}
}

?>