<?php
    include './src/App/Controllers/LoginController.php';
	
	use App\Controllers\LoginController;

	$login = new LoginController;

    // Initialize session
    session_start();

    // Define empty variables
    $username = $user_password = "";
    $username_error = $password_error = "";

    if ($_POST) {
        // Check if username is empty
        if (empty(trim($_POST["username"]))) {
            $username_error = "<span style='color: red'>Please enter your username.</span>";
        } else {
            $username = trim($_POST["username"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_error = "<span style='color: red'>Please enter your password.</span>";
        } else {
            $user_password = trim($_POST["password"]);
        }
        
        if (empty($username_error) && empty($password_error)) {
            $login->username = $username;
            $stmt = $login->getUserData();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                extract($row);

                // Verify password
                $verify = password_verify($user_password, $row["password"]);

                if ($verify) {
                    session_regenerate_id(true);

                    // Session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["role_id"] = $row["role_id"] ?? 0;
                    $_SESSION["username"] = $username;
                    
                    header("location: views/Users/index.php");
                } else {
                    $password_error  = "<span style='color: red'>Invalid username or password.</span>";
                }   
            } else {
                $username_error  = "<span style='color: red'>Invalid username or password.</span>";
            }          
        }
    }
?>