<?php
session_start();

// Ensure the user is logged in before accessing the dashboard
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Display dashboard content
// echo "Welcome to the Dashboard, " . htmlspecialchars($_SESSION['username']) . "!";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

        <!-- Logout Button -->
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>

</html>