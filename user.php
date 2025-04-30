<?php
    require "config.php" ;



        $sql = "CREATE TABLE IF NOT EXISTS mota3alim (
            id INT AUTO_INCREMENT PRIMARY KEY,
            NAME VARCHAR(255),
            EMAIL VARCHAR(255) UNIQUE,
            AGE INT,
            MAJOR varchar(100),
            PHONE varchar(10),
            ADDRESS VARCHAR(255),
            PASSWORD VARCHAR(255) UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);


    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $NAME = $_POST['NAME'];
        $EMAIL = $_POST['EMAIL'];
        $AGE = $_POST['AGE'];
        $MAJOR = $_POST['MAJOR'];
        $PHONE = $_POST['PHONE'];
        $ADDRESS = $_POST['ADDRESS'];
        $PASSWORD = password_hash($_POST['PASSWORD'],PASSWORD_DEFAULT);

        // Hash the password

        // Check if email or phone already exists
        $check = $pdo->prepare("SELECT * FROM mota3alim WHERE EMAIL = ? OR PHONE = ?");
        $check->execute([$EMAIL, $PHONE]);
        if ($check->fetch()) {
            die("❌ Email or phone already exists. Try again.");
        }

        // Insert user
        $stnt = $pdo->prepare("INSERT INTO mota3alim (NAME,EMAIL,AGE,MAJOR,PHONE,ADDRESS,PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stnt->execute([$NAME,$EMAIL,$AGE,$MAJOR,$PHONE,$ADDRESS,$PASSWORD]);

        // Redirect after success
        header("Location: ./login.php");
        exit;
    }

?>








<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Form</title>
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
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2 style="text-align: center;">Mota3alim forum</h2>
    <input type="text" name="NAME" placeholder="Full Name" required>
    <input type="email" name="EMAIL" placeholder="Email" required>
    <input type="number" name="AGE" placeholder="Age" required>
    <input type="text" name="MAJOR" placeholder="Major" required>
    <input type="text" name="PHONE" placeholder="Phone Number" maxlength="10" required>
    <input type="text" name="ADDRESS" placeholder="Address" required>
    <input type="password" name="PASSWORD" placeholder="password" required>
    <button type="submit">Submit</button>
</form>

</body>
</html>