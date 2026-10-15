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

	## SEARCH AND PAGINATION BLOCK ##
	// Get search keyword
    $search = trim($_GET['search'] ?? '');

    // Pagination settings
    $perPage = 5;
    $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $currentPage = max(1, $currentPage);

    // Get all users
    $data = $user->getAllData($search);
    $data = is_array($data) ? $data : [];

    // Calculate pagination
    $totalRecords = count($data);
    $totalPages = (int) ceil($totalRecords / $perPage);

    // Prevent requesting a page beyond the available pages
    if ($totalPages > 0 && $currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    // Calculate offset and get current page records
    $offset = ($currentPage - 1) * $perPage;
    $paginatedData = array_slice($data, $offset, $perPage);

    // Function for pagination URLs
    function paginationUrl(int $page, string $search): string
    {
        return '?' . http_build_query([
            'page' => $page,
            'search' => $search
        ]);
    }
	## END SEARCH AND PAGINATION BLOCK ##

	## CRUD FUNTIONALITY BLOCK ##
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
	## END CRUD FUNTIONALITY BLOCK ##
?>