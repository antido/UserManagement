<?php 
	include_once "../../src/App/Services/user_service.php";
?>

<?php include '../includes/header.php'; ?>

	<div class="container-fluid my-5">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<a href="create.php" class="btn-solid theme-success my-2 btn-md float-end" title="Add User"><i class="fas fa-plus"></i> Add User</a>
				<table class="table table-striped table-bordered">
					<thead class="thead-dark">
						<tr>
							<th></th>
							<th>UserId</th>
							<th>UserName</th>
							<th>Name</th>
							<th>Date Created</th>
							<th>Position</th>
							<th>Status</th>
							<th>Control</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							use App\Controllers\UserController;
							
							$user = new UserController;
							$data = $user->getAllData();
							if (count($data) > 0) {
								foreach ($data as $key => $row) {
						?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo htmlspecialchars($row['id']) ?? ''; ?></td>
								<td><?php echo htmlspecialchars($row['username']) ?? ''; ?></td>
								<td><?php echo htmlspecialchars($user->getFullNameData($row['id'])); ?></td>
								<td>
									<?php 
										echo !empty($row['created_at'])
												? date('F j, Y', strtotime($row['created_at']))
												: '';
								 	?>
								</td>
								<td><?php echo htmlspecialchars($row['position']) ?? ''; ?></td>
								<td><?php echo htmlspecialchars($row['status']) ?? ''; ?></td>
								<td>
									<a 
										href="view.php?view=1&id=<?php echo $row['id']; ?>" 
										class="btn btn-md btn-secondary" 
										title="Show"
									>
										<i class="fas fa-eye"></i>
									</a>
									<a 
										href="edit.php?update=1&id=<?php echo $row['id']; ?>" 
										class="btn btn-md btn-primary" 
										title="Edit"
									>
										<i class="fas fa-pencil-alt"></i>
									</a>
									<a 
										href="index.php?del=1&id=<?php echo $row['id']; ?>" 
										onclick="return confirm('Are you sure youn want to delete this user?');" 
										class="btn btn-md btn-danger" 
										title="Delete"
									>
										<i class="fas fa-trash-alt"></i>
									</a>
								</td>
							</tr>
						<?php
								}
							} else {
						?>
							<tr>
								<td colspan="6">
									<p class="text-center fg-secondary">No Data Found!</p>
								</td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php include '../includes/footer.php'; ?>