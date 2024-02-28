<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember_me = isset($_POST["remember_me"]) ? $_POST["remember_me"] : '';


    // Validate blank field
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill in all information";
        header("Location: register.php");
        exit;
        // Validate email using regex
    }  else {
        // Database connection configuration
        $db = "mysql:host=localhost;dbname=test";
        $username_db = "root";
        $password_db = "";

        try {
            $pdo = new PDO($db, $username_db, $password_db);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");

            $stmt->bindParam(':username', $username);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify password
                if (password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $user['username'];
                    header("Location: welcome.php");
                    exit;
                } else {
                    $_SESSION['error'] = "Incorrect username or password.";
                    header("Location: login.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Incorrect username or password.";
                header("Location: login.php");
                exit;
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: ". $e->getMessage();
            header("Location: login.php");
            exit;
        }
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