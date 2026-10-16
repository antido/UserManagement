<?php
    include './src/App/Controllers/LoginController.php';
	
	use App\Controllers\LoginController;

	$login = new LoginController;

    // Initialize session
    session_start();

    // Define empty variables
    $username = $userPassword = "";
    $usernameError = $passwordError = "";

    if ($_POST) {
        // Check if username is empty
        if (empty(trim($_POST["username"]))) {
            $usernameError = "Please enter your username.";
        } else {
            $username = trim($_POST["username"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $passwordError = "Please enter your password.";
        } else {
            $userPassword = trim($_POST["password"]);
        }
        
        if (empty($usernameError) && empty($passwordError)) {
            $login->username = $username;
            $stmt = $login->getUserData();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                extract($row);

                // Verify password
                $verify = password_verify($userPassword, $row["password"]);

                $checkActive = $login->checkIfActive();
                if (!$checkActive) {
                    $usernameError = "Your account is inactive.";
                } else {
                    if ($verify) {
                        session_regenerate_id(true);

                        // Session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $row["id"];
                        $_SESSION["role_id"] = $row["role_id"] ?? 0;
                        $_SESSION["username"] = $username;
                        
                        header("location: views/Users/index.php");
                    } else {
                        $passwordError  = "Invalid username or password.";
                    }   
                }
            } else {
                $usernameError  = "Invalid username or password.";
            }          
        }
    }
?>