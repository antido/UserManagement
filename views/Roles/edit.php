<?php
	include_once __DIR__ . "/../../src/App/Services/role_service.php";

	if (!hasPermission('edit_role', $rolePermission)) {
		header("Location: ../unauthorized.php");
		exit();
	}

	include "../includes/header.php";
	include "../includes/nav.php";
?>

<?php include '../includes/header.php'; ?>

	<div class="container my-5">

		<a href="index.php" class="text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

		<!-- Edit Role -->
		<div class="row justify-content-center">
			<div class="col-6 border rounded">
				<h4 class="text-center fg-secondary my-5">
					<i class="fas fa-users"></i> Edit Role
				</h4>

				<form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" class="form-control" name="id" value="<?php echo htmlspecialchars(oldValue('id', $data['id'] ?? '')); ?>">

					<div class="mb-3">
                        <label for="role_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="role_name" name="role_name" value="<?php echo htmlspecialchars(oldValue('role_name', $data['name'] ?? '')); ?>">
						<small class="fg-danger"><?php echo htmlspecialchars($errors['role_name'] ?? ''); ?></small> 
                    </div>

					<div class="my-5">
						<button type="submit" class="btn-solid theme-primary" name="edit">
							Update Role
						</button>
					</div>
					
				</form>
			</div>
		</div>

		<!-- Add Permission to Roles -->
		<div class="row justify-content-center mt-5">
			<div class="col-6 border rounded">
				<h4 class="text-center fg-secondary my-5">
					<i class="fas fa-user-gear"></i> Add Permission
				</h4>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="hidden" name="role_id" value="<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">
					
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Permission</th>
								<th scope="col">Index</th>
								<th scope="col">View</th>
								<th scope="col">Create</th>
								<th scope="col">Edit</th>
								<th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach(APP_MODULES as $module): 
									$moduleKey = strtolower(str_replace(' ', '_', trim($module)));
							?>
								<tr>
									<th>
										<?php echo htmlspecialchars($module); ?>
									</th>
									<?php foreach (ACTIONS as $action): ?>
										<?php
											// Create Value Based on Constant Action and Module
											$staticPermission = $action . '_' . $moduleKey;

											// Get All Created Permissions
											$permissions = $permission->getAllData();
											
											// List Available Permissions and Saved Role Permissions
											$savedPermissionNames = array_column($savedPermissions, 'name');
											$availablePermissions = array_column($permissions, 'name');

											// Condition for Checked and Disabled Switch
											$isChecked = in_array($staticPermission, $savedPermissionNames, true);
											$isAvailable = in_array($staticPermission, $availablePermissions, true);

											$switchId = 'permission_' . $staticPermission;
										?>

										<td>
											<div class="switch">
												<input
													type="checkbox"
													name="permissions[]"
													value="<?php echo htmlspecialchars($staticPermission); ?>"
													id="<?php echo htmlspecialchars($switchId); ?>"
													role="switch"
													switch
													<?php echo $isChecked ? 'checked' : ''; ?>
													<?php echo !$isAvailable ? 'disabled' : ''; ?>
												>
											</div>
										</td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

					<div class="my-5">
						<button type="submit" class="btn-solid theme-primary" name="add_role">
							Update Role Permissions
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php include "../includes/footer.php"; ?>