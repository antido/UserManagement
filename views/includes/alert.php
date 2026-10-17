<div class="d-flex justify-content-center align-items-center w-100 mb-5">	
    <!-- Success -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert theme-success alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Error -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert theme-danger alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</div>