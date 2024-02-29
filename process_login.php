<?php
session_start();
include 'db_connection.php';

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
        // Connect to the database
        Database::connect("localhost", "test", "root", "");

        try {
            $pdo = Database::getPDO();
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");

            $stmt->bindParam(':username', $username);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            switch (true) {
                case !$user || !password_verify($password, $user['password']):
                    $error_message = "Incorrect username or password.";
                    break;
                default:
                    $_SESSION['username'] = $user['username'];
                    header("Location: welcome.php");
                    exit;
            }
            
            $_SESSION['error'] = $error_message;
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: ". $e->getMessage();
            header("Location: login.php");
            exit;
        } finally {
            Database::close();
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