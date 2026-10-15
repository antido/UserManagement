<?php 
	include_once __DIR__ . "/../../src/App/Services/user_service.php";
	include "../includes/header.php";
	include "../includes/nav.php";

	if (!hasPermission('create_user', $rolePermission)) {
		header("Location: ../unauthorized.php");
		exit();
	}
?>

	<div class="container my-5">

		<a href="index.php" class="text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

		<div class="row justify-content-center">
			<div class="col-6 border rounded">
				<h4 class="text-center fg-success my-5">
					<i class="fas fa-user-alt"></i> Add User
				</h4>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<!-- User Account -->
					<div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>

					<div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email_address" placeholder="Email Address">
                    </div>

					<div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

					<div class="mb-3">
                        <label for="re-password" class="form-label">Re-Type Password</label>
                        <input type="password" class="form-control" id="re-password" name="repassword" placeholder="Re-Type Password">
                    </div>
					<!-- End User Account -->

					<!-- User Profile -->
					<div class="mb-3">
                        <label for="firstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Firstname">
                    </div>

					<div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Lastname">
                    </div>

					<div class="mb-3">
                        <label for="middlename" class="form-label">Middlename</label>
                        <input type="text" class="form-control" id="middlename" name="middle_name" placeholder="Middlename">
                    </div>

					<div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    </div>

					<div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="Company">
                    </div>

					<div class="mb-3">
                        <label for="contact" class="form-label">Contact no.</label>
                        <input type="text" class="form-control" id="contact" name="contact_no" placeholder="Contact">
                    </div>

					<div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" placeholder="Position">
                    </div>

					<div class="mb-3">
						<label for="" class="form-label">Status</label>
						<div class="form-field">
							<input class="radio" name="status" type="radio" id="radioLabel" value="Active" />
							<label for="radioLabel">Active</label>
						</div>
						<div class="form-field">
							<input class="radio" name="status" type="radio" id="radioLabel2" value="Deactivated" />
							<label for="radioLabel2">Deactivate</label>
						</div>
					</div>
					<!-- End User Profile -->

					<div class="my-5">
						<button type="submit" class="btn-solid theme-primary" name="add">
							Save User
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