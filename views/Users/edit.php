<?php
	include_once __DIR__ . "/../../src/App/Services/user_service.php";
	include "../includes/header.php";
	include "../includes/nav.php";

	if (!hasPermission('edit_user', $rolePermission)) {
		header("Location: ../unauthorized.php");
		exit();
	}
?>

	<div class="container my-5">

		<a href="index.php" class="text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

		<div class="row justify-content-center">
			<div class="col-6 border rounded">
				<h4 class="text-center fg-primary my-5">
					<i class="fas fa-pencil-alt"></i> Edit User
				</h4>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" class="form-control" name="id" value="<?php echo $data['id'] ?? 0; ?>">

					<!-- User Account -->
					<div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['username'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email_address" value="<?php echo $data['email_address'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $data['password'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="re-password" class="form-label">Re-Type Password</label>
                        <input type="password" class="form-control" id="re-password" name="repassword">
                    </div>
					<!-- End User Account -->

					<!-- User Profile -->
					<div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="first_name" value="<?php echo $data['first_name'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="last_name" value="<?php echo $data['last_name'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="middlename" class="form-label">Middlename</label>
                        <input type="text" class="form-control" id="middlename" name="middle_name" value="<?php echo $data['middle_name'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company" value="<?php echo $data['company'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="contact" class="form-label">Contact no.</label>
                        <input type="text" class="form-control" id="contact" name="contact_no" value="<?php echo $data['contact_no'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?php echo $data['position'] ?? ''; ?>">
                    </div>

					<div class="mb-3">
						<label for="" class="form-label">Status</label>
						<div class="form-field">
							<input class="radio" name="status" type="radio" id="radioLabel" value="Active" <?php echo (($data['status'] ?? 'Active') === 'Active') ? 'checked' : ''; ?> />
							<label for="radioLabel">Active</label>
						</div>
						<div class="form-field">
							<input class="radio" name="status" type="radio" id="radioLabel2" value="Deactivated" <?php echo (($data['status'] ?? 'Deactivated') === 'Deactivated') ? 'checked' : ''; ?> />
							<label for="radioLabel2">Deactivate</label>
						</div>
					</div>
					<!-- End User Profile -->

					<div class="my-5">
						<button type="submit" class="btn-solid theme-primary" name="edit">
							Update User
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>

<?php include "../includes/footer.php"; ?>