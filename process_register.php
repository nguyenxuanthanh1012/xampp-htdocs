<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $agree_terms = isset($_POST["agree_terms"]) ? $_POST["agree_terms"] : '';

        $password_pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,20}$/';

        // Validate blank field
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password) ) {
            $_SESSION['error'] = "Please fill in all information";
            header("Location: register.php");
            exit;
            // Validate email using regex
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email format is invalid.";
            header("Location: register.php");
            exit;
            // Validate password using regex
        } elseif (!preg_match($password_pattern, $password)) {
            $_SESSION['error'] = "Password is invalid, valid password must have 8-20 characters long, include at least one uppercase letter, one lowercase letter, and one special character.";
            header("Location: register.php");
            exit;
        } elseif ($password !== $confirm_password) {
            $_SESSION['error'] = "Password and confirm password are not matched.";
            header("Location: register.php");
            exit;
            // Checkbox
        } elseif (empty($agree_terms)) {
            $_SESSION['error'] = "You must agree to the terms & conditions.";
            header("Location: register.php");
            exit;
            // Validate successfully
        } else {
            // Database connection configuration
            $db = "mysql:host=localhost;dbname=test";
            $username_db = "root";
            $password_db = "";

            try {
                $pdo = new PDO($db, $username_db, $password_db);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);

                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $hashed_password);

                $stmt->execute();

                $_SESSION['success'] = "Registration successful!";
                header("Location: register.php");
                exit;

            } catch (PDOException $e) {
                $_SESSION['error'] = "Database error: ". $e->getMessage();
                header("Location: register.php");
                exit;
            }

            $_SESSION['success'] = "User account registered successfully.";
            header("Location: register.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en" data-theme="retro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Register</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

</body>
</html>