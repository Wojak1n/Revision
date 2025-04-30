<?php
require "config.php";

// Redirect if not logged in
if (!isset($_SESSION['mota3alim'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['mota3alim']['id'];

// Get user data from DB
$stmt = $pdo->prepare("SELECT * FROM mota3alim WHERE id = :id");
$stmt->execute(['id' => $id_user]);
$user = $stmt->fetch();

// Check if user is found
if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>WELCOME <?php echo htmlspecialchars($user["NAME"]); ?></h1>
<p>my email :<?php echo htmlspecialchars($user["EMAIL"]); ?> </p>
<p>my Phone :<?php echo htmlspecialchars($user["PHONE"]); ?> </p>
<a href="logout.php" class="logout">Logout</a>
\\\\\\\\\\\\\\\\
































<style>
.logout-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #e74c3c;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin-top: 20px;
}

.logout-button:hover {
    background-color: #c0392b;
}
</style>




</body>
</html>
