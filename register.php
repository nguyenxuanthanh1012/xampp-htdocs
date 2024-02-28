<!DOCTYPE html>
<html lang="en" data-theme="retro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="max-w-md mx-auto">
    <h2 class="text-3xl text-center font-semibold mb-6 mt-4">Register</h2>
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo '<div class="text-red-500">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="text-green-500">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
    <form method="post" action="process_register.php">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Username
            </label>
            <input id="username" name="username" type="text" class="input input-bordered w-full py-2 px-3" placeholder="Username">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input id="email" name="email" type="text" class="input input-bordered w-full py-2 px-3" placeholder="Email">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input id="password" name="password" type="password" class="input input-bordered w-full py-2 px-3" placeholder="Password">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                Confirm Password
            </label>
            <input id="confirm_password" name="confirm_password" type="password" class="input input-bordered w-full py-2 px-3" placeholder="Confirm Password">
        </div>
        <div class="mb-4 flex">
            <label class="cursor-pointer label">
                <input type="checkbox" checked="checked" name="agree_terms" class="checkbox checkbox-info" />
                <span class="label-text ml-4">I agree to all terms & conditions</span>
            </label>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="btn btn-outline btn-info">Register</button>
        </div>
        <div class="mb-4 text-center">
            <p>Already having an account? Login <a href="login.php" class="link link-info">here</a>.</p>
        </div>
    </form>
</div>
</body>
</html>