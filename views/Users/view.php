<?php 
	include_once __DIR__ . "/../../src/App/Services/user_service.php";
	include "../includes/header.php";
	include "../includes/nav.php";
?>

	<div class="container my-5">

        <a href="index.php" class="text-decoration-none"><i class="fa-solid fa-arrow-left"></i> Back</a>

		<div class="row justify-content-center">
			<div class="col-6 border rounded p-5">
				<h6 class="fg-primary mb-5">
					User Account
				</h6>

                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Username
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['username'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Email Address
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['email_address'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Password
                        <span class="badge theme-primary">********</span>
                    </li>
                </ul>
			</div>
		</div>

        <div class="row justify-content-center mt-5">
			<div class="col-6 border rounded p-5">
				<h6 class="fg-primary mb-5">
					User Profile
				</h6>

                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Firstname
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['first_name'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Middlename
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['middle_name'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Lastname
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['last_name'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Address
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['address'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Company
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['company'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Contact No.
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['contact_no'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Position
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['position'] ?? ''); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status
                        <span class="badge theme-primary"><?php echo htmlspecialchars($data['status'] ?? ''); ?></span>
                    </li>
                </ul>
			</div>
		</div>
	</div>

<?php include "../includes/footer.php"; ?>