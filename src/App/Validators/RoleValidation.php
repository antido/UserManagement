<?php

namespace App\Validators;

use App\Controllers\RoleController;

class RoleValidation {
    public function validate(array $input, RoleController $role, string $action = '', int $id = 0): array
    {
        $errors = [];

        $name = trim($input['role_name'] ?? '');

        // Role Name
        if ($name === '') {
            if ($action !== 'edit') {
                $errors['role_name'] = 'Role name is required.';
            }
        } elseif ($role->checkData($name, $id)) {
            $errors['role_name'] = 'Role name already exists.';
        }

        return $errors;
    }
}

?>