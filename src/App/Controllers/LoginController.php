<?php

namespace App\Controllers;

require_once __DIR__ . '/../../../vendor/autoloader.php';

use App\Models\Auth;
use PDOStatement;

class LoginController extends Auth {

	public string $username;

    public function getUserData(): PDOStatement
    {
        $data = $this->getData($this->username);

		return $data;
    }
}

?>