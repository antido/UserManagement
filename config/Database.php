<?php

class Database {

	public PDO $conn;
	private string $host = "127.0.0.1;port=21000";
	private string $database = "user_management";
	private string $user = "root";
	private string $pass = "antido@2024;";

	public function __construct()
	{
		try {
			$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->pass);

			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			die("Connection error: " . $e->getMessage());
		}
	}
}

?>