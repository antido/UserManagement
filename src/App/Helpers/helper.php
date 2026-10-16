<?php
    use App\Controllers\RolePermissionController;

    // Pagination URLs
    function paginationUrl(int $page, string $search): string
    {
        return '?' . http_build_query([
            'page' => $page,
            'search' => $search
        ]);
    }

    // Check for role permission
    function hasPermission(string $permission_name, RolePermissionController $rolePermission): bool
    {
        return $rolePermission->checkHasPermission($_SESSION["role_id"], $permission_name);
    }

    // Retain entered field values
    function oldValue(string $key, string $default = ''): string
    {
        return htmlspecialchars(
            (string) ($_POST[$key] ?? $default),
            ENT_QUOTES,
            'UTF-8'
        );
    }
?>