<?php
    require "config.php";

    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $EMAIL = $_POST['EMAIL'];
        $PASSWORD = $_POST['PASSWORD'];

       
        $stmt = $pdo->prepare("SELECT * FROM mota3alim WHERE email = :email");
        $stmt->execute(['email' => $EMAIL]);
        $user = $stmt->fetch();

       
        if ($user && $PASSWORD = $user["PASSWORD"]) {
            $message = "✅ Login successful!";
            header('location: ./dashboard.php');
            $_SESSION['mota3alim'] = $user;


        } else {
            $message = "❌ Invalid email or password!";
            header('location: /login.php');
        
        }
    }

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f4f4f4;
        }

        form {
            background: white;
            padding: 20px;
            max-width: 412px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }

        input, select {
            width: 100%;
            margin: 8px 0;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background: #2ecc71;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2 style="text-align: center;">Mota3alim Forum</h2>

    <?php if (!empty($message)) : ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <input type="email" name="EMAIL" placeholder="Email" required>
    <input type="password" name="PASSWORD" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

</body>
</html>
