<?php
	// Initialize session
	session_start();

	// Check if the user session variable is set
	if (!isset($_SESSION['user_id'])) {
		header("Location: ../../index.php");
		exit();
	}

    include '../../src/App/Controllers/UserController.php';
	
	use App\Controllers\UserController;

	$user = new UserController;

    // Add User
	if (isset($_POST['add'])) {
		$data = array(
			'username' 		=> trim($_POST['username']) ?? '',
			'email_address' => trim($_POST['email_address']) ?? '',
			'first_name' 	=> trim($_POST['first_name']) ?? '',
			'last_name' 	=> trim($_POST['last_name']) ?? '',
			'middle_name' 	=> trim($_POST['middle_name']) ?? '',
			'address' 		=> trim($_POST['address']) ?? '',
			'company' 		=> trim($_POST['company']) ?? '',
			'contact_no' 	=> trim($_POST['contact_no']) ?? '',
			'position' 		=> trim($_POST['position']) ?? '',
			'status' 		=> trim($_POST['status']) ?? 'Active'
		);

		if (!empty(trim($_POST['password']))) {
			$data['password'] = password_hash(
				trim($_POST['password']),
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
			'username'      => trim($_POST['username']) ?? '',
			'email_address' => trim($_POST['email_address']) ?? '',
			'first_name'    => trim($_POST['first_name']) ?? '',
			'last_name'     => trim($_POST['last_name']) ?? '',
			'middle_name'   => trim($_POST['middle_name']) ?? '',
			'address'       => trim($_POST['address']) ?? '',
			'company'       => trim($_POST['company']) ?? '',
			'contact_no'    => trim($_POST['contact_no']) ?? '',
			'position'      => trim($_POST['position']) ?? '',
			'status'        => trim($_POST['status']) ?? 'Active',
		];

		if (!empty(trim($_POST['password']))) {
			$data['password'] = password_hash(
				trim($_POST['password']),
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