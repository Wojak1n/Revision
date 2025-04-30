<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matiere = $_POST['matiere'];
    $duree = intval($_POST['duree']);
    $note = intval($_POST['note']);
    $date = $_POST['date'];

    // Vérifications
    if (empty($matiere) || empty($duree) || empty($note) || empty($date)) {
        $erreur = "Tous les champs sont obligatoires";
    } elseif ($note < 0 || $note > 10) {
        $erreur = "La note doit être entre 0 et 10";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO revisions (utilisateur_id, matiere, duree, note, date) 
                                  VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $matiere, $duree, $note, $date]);
            header("Location: revisions.php");
            exit();
        } catch (PDOException $e) {
            $erreur = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Ajouter une révision</title></head>
<body>
    <?php if (!empty($erreur)): ?>
        <p style="color:red;"><?php echo $erreur; ?></p>
    <?php endif; ?>
    <form method="POST">
        Matière : <input type="text" name="matiere" required><br>
        Durée (minutes) : <input type="number" name="duree" required><br>
        Note (0-10) : <input type="number" name="note" min="0" max="10" required><br>
        Date : <input type="date" name="date" required><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>