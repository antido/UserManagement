<?php
    // Initialize session
	session_start();

	// Check if the user session variable is set
	if (!isset($_SESSION['user_id'])) {
		header("Location: ../../index.php");
		exit();
	}

    include '../../src/App/Controllers/PermissionController.php';
    include '../../src/App/Helpers/helper.php';
	include "../../src/App/Validators/PermissionValidation.php";
	
	use App\Controllers\PermissionController;
	use App\Controllers\RolePermissionController;
	use App\Validators\PermissionValidation;

	$permission = new PermissionController;
	$rolePermission = new RolePermissionController;
	$validator = new PermissionValidation;

	## SEARCH AND PAGINATION BLOCK ##
	// Get search keyword
    $search = trim($_GET['search'] ?? '');

    // Pagination settings
    $perPage = 5;
    $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $currentPage = max(1, $currentPage);

    // Get all permissions
    $data = $permission->getAllData($search);
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
	## END SEARCH AND PAGINATION BLOCK ##

	## CRUD FUNTIONALITY BLOCK ##
    // Add Permission
	if (isset($_POST['add'])) {
		// For validation
		$errors = $validator->validate($_POST, $permission);

		if (empty(array_filter($errors))) {
			$data = array(
				'name' => trim($_POST['permission_name']) ?? ''
			);

			if ($permission->insertData($data)) {
				header('Location: index.php?store="Success"');
			}
		}
	}

    // Edit Permission
    if (isset($_GET['update'])) {
		$id = $_GET['id'] ?? 0;

		$data = $permission->selectData($id);
	}

	if (
		isset($_POST['edit']) && 
		$_SERVER['REQUEST_METHOD'] === 'POST' &&
    	($_POST['_method'] ?? '') === 'PUT'
	) {
		$id = $_POST['id'] ?? 0;

		// For validation
		$errors = $validator->validate($_POST, $permission, 'edit', $id);

		if (empty(array_filter($errors))) {	
			$data = [
				'name' => trim($_POST['permission_name']) ?? ''
			];

			if ($permission->editData($id, $data)) {
				header('Location: index.php?edit=Success');
			}
		}
	}

    // View Permission
    if (isset($_GET['view'])) {
		$id = $_GET['id'] ?? 0;

		$data = $permission->selectData($id);
	}

    // Delete Permission
    if (isset($_GET['del'])) {
		$id = $_GET['id'] ?? 0;

		if ($permission->deleteData($id)) {
			header('Location: index.php?delete=Success');
		}
	}
	## END CRUD FUNTIONALITY BLOCK ##
?>