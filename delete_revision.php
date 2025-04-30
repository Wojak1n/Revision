<?php
require 'config.php';

if (!isset($_SESSION['mota3alim'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

echo $_SESSION['mota3alim']['id'];


    $stmt = $pdo->prepare("SELECT * FROM revisions WHERE utilisateur_id = ?");
    $stmt->execute([$_SESSION['mota3alim']['id']]);
    $res=$stmt->fetch(PDO::FETCH_ASSOC);
    print_r($res) ;
    if ($res) {
        $sql=$pdo->prepare("DELETE FROM revisions WHERE utilisateur_id = ?");
        $stmt->execute([$res['id']]);

    }
    exit();
}