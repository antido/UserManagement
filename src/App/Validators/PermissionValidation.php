<?php

namespace App\Validators;

use App\Controllers\PermissionController;

class PermissionValidation {
    public function validate(array $input, PermissionController $permission, string $action = '', int $id = 0): array
    {
        $errors = [];

        $name = trim($input['permission_name'] ?? '');

        // Permission Name
        if ($name === '') {
            if ($action !== 'edit') {
                $errors['permission_name'] = 'Permission name is required.';
            }
        } elseif ($permission->checkData($name, $id)) {
            $errors['permission_name'] = 'Permission name already exists.';
        }

        return $errors;
    }
}

?>