<?php
    // Get search keyword
    $search = trim($_GET['search'] ?? '');

    // Pagination settings
    $perPage = 5;
    $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $currentPage = max(1, $currentPage);

    // Get all users
    $data = $paginationData->getAllData($search);
    $data = is_array($data) ? $data : [];

    // Calculate pagination
    $totalRecords = count($data);
    $totalPages = (int) ceil($totalRecords / $perPage);

    // Prevent requesting a page beyond the available pages
    if ($totalPages > 0 && $currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    // Calculate offset and get current page records
    $offset = ($currentPage - 1) * $perPage;
    $paginatedData = array_slice($data, $offset, $perPage);
?>