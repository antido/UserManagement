<?php
	include_once __DIR__ . "/../../src/App/Services/permission_service.php";

	if (!hasPermission('edit_permission', $rolePermission)) {
		header("Location: ../unauthorized.php");
		exit();
	}

	include "../includes/header.php";
	include "../includes/nav.php";
?>

	<div class="container my-5">

		<a href="index.php" class="text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

		<div class="row justify-content-center">
			<div class="col-6 border rounded">
				<h4 class="text-center fg-primary my-5">
					<i class="fas fa-users"></i> Edit Permission
				</h4>

				<form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" class="form-control" name="id" value="<?php echo htmlspecialchars(oldValue('id', $data['id'] ?? '')); ?>">

					<div class="mb-3">
                        <label for="permission_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="permission_name" name="permission_name" value="<?php echo htmlspecialchars(oldValue('permission_name', $data['name'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['permission_name'] ?? ''); ?></small> 
                    </div>

					<div class="my-5">
						<button type="submit" class="btn-solid theme-primary" name="edit">
							Update Permission
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>

<?php include "../includes/footer.php"; ?>