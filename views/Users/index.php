<?php 
	include_once __DIR__ . "/../../src/App/Services/user_service.php";
	include "../includes/header.php";
	include "../includes/nav.php";
?>

	<div class="container-fluid my-5">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="d-flex">
					<div class="p-2 flex-fill">
						<form action="index.php" method="GET" class="d-flex align-items-center gap-2">
							<span>Search:</span>
							<input type="text" class="form-control" id="search" name="search" value="<?php echo htmlspecialchars($search); ?>">

							<button type="submit" class="btn-solid theme-inverse">
								Search
							</button>

							<a href="index.php" class="btn-solid theme-inverse" id="resetBtn">
								Clear Search
							</a>
						</form>
					</div>
					
					<div class="p-2 flex-fill">
						<a href="create.php" 
							class="btn-solid theme-primary my-2 btn-md float-end 
							<?php echo (!hasPermission('create_user', $rolePermission)) ? "disabled" : ""; ?>" 
							title="Add User"
						>
							<i class="fas fa-plus"></i> Add User
						</a>
					</div>
				</div>

				<!-- Users Table -->
				<div class="table-responsive">
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
							<?php if (!empty($paginatedData)): ?>

								<?php foreach ($paginatedData as $row): ?>
									<tr>
										<td><input type="checkbox" class="check"></td>
										<td><?php echo htmlspecialchars($row['id'] ?? ''); ?></td>
										<td><?php echo htmlspecialchars($row['username'] ?? ''); ?></td>
										<td><?php echo htmlspecialchars($user->getFullNameData($row['id'])); ?></td>
										<td>
											<?php
												echo !empty($row['created_at'])
													? date('F j, Y', strtotime($row['created_at']))
													: '';
											?>
										</td>
										<td><?php echo htmlspecialchars($row['position'] ?? ''); ?></td>
										<td><?php echo htmlspecialchars($row['status'] ?? ''); ?></td>
										<td>
											<a
												href="view.php?view=1&id=<?php echo urlencode($row['id']); ?>"
												class="btn-solid btn-sm theme-success"
												title="Show"
											>
												<i class="fas fa-check"></i>
											</a>
											<a
												href="edit.php?update=1&id=<?php echo urlencode($row['id']); ?>"
												class="btn-solid btn-sm theme-warning
												<?php echo (!hasPermission('edit_user', $rolePermission) && $_SESSION['user_id'] !== $row['id']) ? "disabled" : ""; ?>" 
												title="Edit"
											>
												<i class="fas fa-pencil-alt"></i>
											</a>
											<a
												href="index.php?del=1&id=<?php echo urlencode($row['id']); ?>"
												onclick="return confirm(
													'Are you sure you want to delete this user?'
												);"
												class="btn-solid btn-sm theme-danger
												<?php echo (!hasPermission('delete_user', $rolePermission)) ? "disabled" : ""; ?>" 
												title="Delete"
											>
												<i class="fas fa-times"></i>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>

							<?php else: ?>

								<tr>
									<td colspan="8">
										<p class="text-center fg-secondary mb-0">
											No Data Found!
										</p>
									</td>
								</tr>

							<?php endif; ?>
						</tbody>
					</table>
				</div>

				<!-- Pagination -->
				<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

					<div>
						Showing
						<?php echo $totalRecords > 0 ? $offset + 1 : 0; ?>
						to
						<?php echo min($offset + $perPage, $totalRecords); ?>
						of
						<?php echo $totalRecords; ?>
						entries
					</div>

					<!-- Pagination Links -->
					<?php if ($totalPages > 1): ?>
						<nav aria-label="User pagination">
							<ul class="pagination mb-0">

								<!-- Previous -->
								<li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : '';?>">
									<?php if ($currentPage > 1): ?>
										<a class="page-link"
											href="<?php echo htmlspecialchars(paginationUrl($currentPage - 1, $search)); ?>"
										>
											Previous
										</a>
									<?php else: ?>
										<span class="page-link">Previous</span>
									<?php endif; ?>
								</li>

								<!-- Page Numbers -->
								<?php for ($page = 1; $page <= $totalPages; $page++): ?>
									<li class="page-item <?php echo $page === $currentPage ? 'active' : ''; ?>">
										<a
											class="page-link"
											href="<?php echo htmlspecialchars(paginationUrl($page, $search)); ?>"
											<?php echo $page === $currentPage ? 'aria-current="page"' : ''; ?>
										>
											<?php echo $page; ?>
										</a>
									</li>
								<?php endfor; ?>

								<!-- Next -->
								<li class="page-item <?php echo $currentPage >= $totalPages ? 'disabled' : ''; ?>">
									<?php if ($currentPage < $totalPages): ?>
										<a class="page-link"
											href="<?php echo htmlspecialchars(paginationUrl($currentPage + 1, $search)); ?>"
										>
											Next
										</a>
									<?php else: ?>
										<span class="page-link">Next</span>
									<?php endif; ?>
								</li>
							</ul>
						</nav>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>

<?php include "../includes/footer.php"; ?>