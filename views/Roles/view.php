<?php 
	include_once __DIR__ . "/../../src/App/Services/role_service.php";
	include "../includes/header.php";
	include "../includes/nav.php";
?>

	<div class="container my-5">

        <a href="index.php" class="text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

		<div class="row justify-content-center">
			<div class="col-6 border rounded p-5">
				<h6 class="fg-primary mb-5">
					Role
				</h6>

                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Name
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['name'] ?? ''); ?></span>
                    </li>
                </ul>
			</div>
		</div>

	</div>

<?php include "../includes/footer.php"; ?>