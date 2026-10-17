<nav class="navbar md:navbar-expand bg-1 fg-2">
  <div class="container-fluid">
    <a
      class="navbar-brand <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' && str_contains($_SERVER['PHP_SELF'], '/Users/') ? 'active' : ''; ?>"
      href="../Users/index.php"
    >
      Home
    </a>
    <button class="btn-icon navbar-toggler" type="button" data-bs-toggle="drawer" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon" aria-hidden="true"></span>
    </button>
    <dialog class="drawer drawer-end" tabindex="-1" id="navbarText" aria-labelledby="navbarTextLabel">
      <div class="drawer-header">
        <h5 class="drawer-title" id="navbarTextLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="drawer" aria-label="Close"></button>
      </div>
      <div class="drawer-body">
        <ul class="navbar-nav me-auto mb-2 md:mb-0">
          <?php if (hasPermission('index_role', $rolePermission)): ?>
            <li class="nav-item">
              <a
                class="nav-link <?php echo str_contains($_SERVER['PHP_SELF'], '/Roles/') ? 'active' : ''; ?>"
                href="../Roles/index.php"
                <?php echo str_contains($_SERVER['PHP_SELF'], '/Roles/') ? 'aria-current="page"' : ''; ?>
              >
                Roles
              </a>
            </li>
          <?php endif; ?>

          <?php if (hasPermission('index_permission', $rolePermission)): ?>
            <li class="nav-item">
              <a
                class="nav-link <?php echo str_contains($_SERVER['PHP_SELF'], '/Permissions/') ? 'active' : ''; ?>"
                href="../Permissions/index.php"
                <?php echo str_contains($_SERVER['PHP_SELF'], '/Permissions/') ? 'aria-current="page"' : ''; ?>
              >
                Permissions
              </a>
            </li>
          <?php endif; ?>
        </ul>
        <span class="navbar-text">
          Hello: <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>
        </span>

        <a href="../../src/App/Services/logout_service.php" class="btn-solid theme-secondary btn-sm">
          Logout
        </a>
      </div>
    </dialog>
  </div>
</nav>