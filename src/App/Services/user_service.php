<?php
    include '../../src/App/Controllers/UserController.php';
	
	use App\Controllers\UserController;

	$user = new UserController;

    // Add User
	if (isset($_POST['add'])) {
		$data = array(
			'username' 		=> $_POST['username'] ?? '',
			'email_address' => $_POST['email_address'] ?? '',
			'first_name' 	=> $_POST['first_name'] ?? '',
			'last_name' 	=> $_POST['last_name'] ?? '',
			'middle_name' 	=> $_POST['middle_name'] ?? '',
			'address' 		=> $_POST['address'] ?? '',
			'company' 		=> $_POST['company'] ?? '',
			'contact_no' 	=> $_POST['contact_no'] ?? '',
			'position' 		=> $_POST['position'] ?? '',
			'status' 		=> $_POST['status'] ?? 'Active'
		);

		if (!empty($_POST['password'])) {
			$data['password'] = password_hash(
				$_POST['password'],
				PASSWORD_DEFAULT
			);
		}

		if ($user->insertData($data)) {
			header('Location: index.php?store="Success"');
		}
	}

    // Edit User
    if (isset($_GET['update'])) {
		$id = $_GET['id'] ?? null;

		$data = $user->selectData($id);
	}

	if (
		isset($_POST['edit']) && 
		$_SERVER['REQUEST_METHOD'] === 'POST' &&
    	($_POST['_method'] ?? '') === 'PUT'
	) {
		$id = $_POST['id'];
		$data = [
			'username'      => $_POST['username'] ?? '',
			'email_address' => $_POST['email_address'] ?? '',
			'first_name'    => $_POST['first_name'] ?? '',
			'last_name'     => $_POST['last_name'] ?? '',
			'middle_name'   => $_POST['middle_name'] ?? '',
			'address'       => $_POST['address'] ?? '',
			'company'       => $_POST['company'] ?? '',
			'contact_no'    => $_POST['contact_no'] ?? '',
			'position'      => $_POST['position'] ?? '',
			'status'        => $_POST['status'] ?? 'Active',
		];

		if (!empty($_POST['password'])) {
			$data['password'] = password_hash(
				$_POST['password'],
				PASSWORD_DEFAULT
			);
		}

		if ($user->editData($id, $data)) {
			header('Location: index.php?edit=Success');
		}
	}

    // View User
    if (isset($_GET['view'])) {
		$id = $_GET['id'] ?? null;

		$data = $user->selectData($id);
	}

    // Delete User
    if (isset($_GET['del'])) {
		$id = $_GET['id'] ?? null;

		if ($user->deleteData($id)) {
			header('Location: index.php?delete=Success');
		}
	}
?>