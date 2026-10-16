<?php

namespace App\Validators;

use App\Controllers\UserController;

class UserValidation {
    public function validate(array $input, UserController $user, string $action = '', int $id = 0): array
    {
        $errors = [];

        $username = trim($input['username'] ?? '');
        $email = trim($input['email_address'] ?? '');
        $password = $input['password'] ?? '';
        $repassword = $input['repassword'] ?? '';
        $firstName = trim($input['first_name'] ?? '');
        $middleName = trim($input['middle_name'] ?? '');
        $lastName = trim($input['last_name'] ?? '');
        $address = trim($input['address'] ?? '');
        $company = trim($input['company'] ?? '');
        $contact = trim($input['contact_no'] ?? '');
        $position = trim($input['position'] ?? '');

        // Username
        if ($action !== 'edit') {
            if ($username === '') {
                $errors['username'] = 'Username is required.';
            } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                $errors['username'] = 'Username should contain letters, numbers and underscore only.';
            } elseif ($user->checkData('username', $username)) {
                $errors['username'] = 'Username already exists.';
            }
        }
        
        // Email
        if ($email === '') {
            $errors['email'] = 'Email address is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email address is not valid.';
        } elseif ($user->checkData('email', $email, $id)) {
            $errors['email'] = 'Email address already exists.';
        }

        // Password
        if ($password === '') {
            if ($action !== 'edit') {
                $errors['password'] = 'Password is required.';
            }
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
        }

        if ($password !== $repassword) {
            $errors['repassword'] = 'Passwords do not match.';
        }

        // First name
        if ($firstName === '') {
            $errors['first_name'] = 'Firstname is required.';
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $firstName)) {
            $errors['first_name'] = 'Firstname should contain letters and spaces only.';
        }

        // Middle name is optional
        if ($middleName !== '' && !preg_match('/^[a-zA-Z ]+$/', $middleName)) {
            $errors['middle_name'] = 'Middlename should contain letters and spaces only.';
        }

        // Last name
        if ($lastName === '') {
            $errors['last_name'] = 'Lastname is required.';
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $lastName)) {
            $errors['last_name'] = 'Lastname should contain letters and spaces only.';
        }

        // Address
        if ($address === '') {
            $errors['address'] = 'Address is required.';
        } elseif (!preg_match('/^[0-9a-zA-Z# ]+$/', $address)) {
            $errors['address'] = 'Address should contain letters, numbers, spaces, and # only.';
        }

        // Company
        if ($company === '') {
            $errors['company'] = 'Company is required.';
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $company)) {
            $errors['company'] = 'Company should contain letters and spaces only.';
        }

        // Contact number
        if ($contact === '') {
            $errors['contact'] = 'Contact number is required.';
        } elseif (!preg_match('/^[0-9]+$/', $contact)) {
            $errors['contact'] = 'Contact number must contain numbers only.';
        }

        // Position
        if ($position === '') {
            $errors['position'] = 'Position is required.';
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $position)) {
            $errors['position'] = 'Position should contain letters and spaces only.';
        }

        return $errors;
    }
}

?>