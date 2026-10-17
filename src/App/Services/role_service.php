<?php
    // Initialize session
	session_start();

	// Check if the user session variable is set
	if (!isset($_SESSION['user_id'])) {
		header("Location: ../../index.php");
		exit();
	}

	include "../../config/Constants.php";
    include "../../src/App/Controllers/RoleController.php";
	include "../../src/App/Helpers/helper.php";
	include "../../src/App/Validators/RoleValidation.php";
	
	use App\Controllers\RoleController;
	use App\Controllers\RolePermissionController;
	use App\Controllers\PermissionController;
	use App\Controllers\UserRoleController;
	use App\Validators\RoleValidation;

	$role = new RoleController;
	$rolePermission = new RolePermissionController;
	$permission = new PermissionController;
	$userRole = new UserRoleController;
	$validator = new RoleValidation;

	## SEARCH AND PAGINATION BLOCK ##
	// Get search keyword
    $search = trim($_GET['search'] ?? '');

    // Pagination settings
    $perPage = 5;
    $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $currentPage = max(1, $currentPage);

    // Get all roles
    $data = $role->getAllData($search);
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
    // Add Role
	if (isset($_POST['add'])) {
		// For validation
		$errors = $validator->validate($_POST, $role);

		if (empty(array_filter($errors))) {
			$data = array(
				'name' => trim($_POST['role_name']) ?? ''
			);

			if ($role->insertData($data)) {
				$_SESSION['success'] = 'Role created successfully.';

				header("Location: index.php");
				exit();
			} else {
				$_SESSION['error'] = 'Failed to create role.';
			}
		}
	}

    // Edit Role
    if (isset($_GET['update'])) {
		$id = $_GET['id'] ?? 0;

		$data = $role->selectData($id);
	}

	if (
		isset($_POST['edit']) && 
		$_SERVER['REQUEST_METHOD'] === 'POST' &&
    	($_POST['_method'] ?? '') === 'PUT'
	) {
		$id = $_POST['id'] ?? 0;

		// For validation
		$errors = $validator->validate($_POST, $role, 'edit', $id);

		if (empty(array_filter($errors))) {	
			$data = [
				'name' => trim($_POST['role_name']) ?? ''
			];

			if ($role->editData($id, $data)) {
				$_SESSION['success'] = 'Role updated successfully.';

				header("Location: index.php");
				exit();
			} else {
				$_SESSION['error'] = 'Failed to update role.';
			}
		}
		
	}

    // View Role
    if (isset($_GET['view'])) {
		$id = $_GET['id'] ?? 0;

		$data = $role->selectData($id);
	}

    // Delete Role
    if (isset($_GET['del'])) {
		$id = $_GET['id'] ?? 0;

		if ($role->deleteData($id)) {
			$_SESSION['success'] = 'Role deleted successfully.';

			header("Location: index.php");
			exit();
		} else {
			$_SESSION['error'] = 'Failed to delete role.';
		}
	}

	// Update Role Permissions
	if (
		isset($_POST['add_role']) &&
		$_SERVER['REQUEST_METHOD'] === 'POST'
	) {
        $id = $_POST['role_id'] ?? 0;

        $selectedPermissions = $_POST['permissions'] ?? [];

        if ($rolePermission->insertData($id, $selectedPermissions)) {
			$_SESSION['success'] = 'Updated role permissions successfully.';

            header("Location: index.php");
			exit();
        } else {
			$_SESSION['error'] = 'Failed to update role permissions.';
		}
    }

	// Get Saved Permissions
    $savedPermissions = $rolePermission->getData($_GET['id'] ?? 0);
	## END CRUD FUNTIONALITY BLOCK ##
?>