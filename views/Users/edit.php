<?php
	include_once __DIR__ . "/../../src/App/Services/user_service.php";

	if (!hasPermission('edit_user', $rolePermission) && $_SESSION['user_id'] !== $data['id']) {
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
				<h4 class="text-center fg-secondary my-5">
					<i class="fas fa-pencil-alt"></i> Edit User
				</h4>

				<form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" class="form-control" name="id" value="<?php echo htmlspecialchars(oldValue('id', $data['id'] ?? '')); ?>">

					<!-- User Account -->
					<div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control bg-muted-secondary" id="username" name="username" value="<?php echo htmlspecialchars(oldValue('username', $data['username'] ?? '')); ?>" readonly>
                    </div>

					<div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email_address" value="<?php echo htmlspecialchars(oldValue('email_address', $data['email_address'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['email'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['password'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="re-password" class="form-label">Re-Type Password</label>
                        <input type="password" class="form-control" id="re-password" name="repassword">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['repassword'] ?? ''); ?></small> 
                    </div>
					<!-- End User Account -->

					<!-- User Profile -->
					<div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="first_name" value="<?php echo htmlspecialchars(oldValue('first_name', $data['first_name'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['first_name'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="last_name" value="<?php echo htmlspecialchars(oldValue('last_name', $data['last_name'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['last_name'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="middlename" class="form-label">Middlename</label>
                        <input type="text" class="form-control" id="middlename" name="middle_name" value="<?php echo htmlspecialchars(oldValue('middle_name', $data['middle_name'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['middle_name'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars(oldValue('address', $data['address'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['address'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company" value="<?php echo htmlspecialchars(oldValue('company', $data['company'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['company'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="contact" class="form-label">Contact no.</label>
                        <input type="text" class="form-control" id="contact" name="contact_no" value="<?php echo htmlspecialchars(oldValue('contact_no', $data['contact_no'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['contact'] ?? ''); ?></small> 
                    </div>

					<div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" value="<?php echo htmlspecialchars(oldValue('position', $data['position'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['position'] ?? ''); ?></small> 
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

		<!-- Assign Role to User -->
		<div class="row justify-content-center mt-5">
			<div class="col-6 border rounded">
				<h4 class="text-center fg-secondary my-5">
					<i class="fas fa-user"></i> Assign Role
				</h4>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">

					<div class="form-field">
						<label for="fieldSelect" class="form-label">Roles</label>
						<select class="form-control" id="fieldSelect" name="role_id">
							<option value="">-- Select From Options --</option>
        
							<?php foreach ($roles as $role): ?>
								<option 
									value="<?php echo $role['id']; ?>" 
									<?php echo $role['id'] === ($savedRole['role_id'] ?? null) ? 'selected' : ''; ?>
								>
									<?php echo htmlspecialchars($role['name']); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="my-5">
						<button type="submit" class="btn-solid theme-primary" name="assign_role">
							Update Role
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>

<?php include "../includes/footer.php"; ?>