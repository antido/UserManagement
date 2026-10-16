<?php 
	include_once __DIR__ . "/../../src/App/Services/role_service.php";

	if (!hasPermission('create_role', $rolePermission)) {
		header("Location: ../unauthorized.php");
		exit();
	}

	include "../includes/header.php";
	include "../includes/nav.php";
?>

<?php include '../includes/header.php'; ?>

	<div class="container my-5">

		<a href="index.php" class="text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

		<div class="row justify-content-center">
			<div class="col-6 border rounded">
				<h4 class="text-center fg-secondary my-5">
					<i class="fas fa-users"></i> Add Role
				</h4>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

					<div class="mb-3">
                        <label for="role_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="role_name" name="role_name" value="<?php echo htmlspecialchars(oldValue('role_name')); ?>" placeholder="Role">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['role_name'] ?? ''); ?></small> 
                    </div>

					<div class="my-5">
						<button type="submit" class="btn-solid theme-primary" name="add">
							Save Role
						</button>

						<button type="button" class="btn-solid theme-inverse" id="resetBtn">
							Reset
                    	</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>

<?php include "../includes/footer.php"; ?>