<!DOCTYPE html>
<html lang="en" data-theme="retro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="max-w-md mx-auto">
    <h2 class="text-3xl text-center font-semibold mb-6 mt-4">Welcome, <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo $_SESSION['username'];
        }
        ?></h2>
</div>
</body>
</html>