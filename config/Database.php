<?php

class Database {

	public PDO $conn;
	private string $host = "";
	private string $database = "";
	private string $user = "";
	private string $pass = "";

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