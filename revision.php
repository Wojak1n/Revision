<?php
require 'config.php';

if (!isset($_SESSION['mota3alim'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['Supprimer'])) {
    $id=$_POST['id'];
    $stmt = $pdo->prepare("SELECT * FROM revisions WHERE utilisateur_id = ?");
    $stmt->execute([$_SESSION['mota3alim']['id']]);
    $res=$stmt->fetch(PDO::FETCH_ASSOC);
    print_r($res) ;
    if ($res) {
        $sql=$pdo->prepare("DELETE FROM revisions WHERE utilisateur_id = ?");
        $stmt->execute([$id]);

    }
    
}
$stmt = $pdo->prepare("SELECT * FROM  revisions
                      WHERE utilisateur_id = ? 
                      ORDER BY date DESC");
$stmt->execute([$_SESSION['mota3alim']['id']]);
$revisions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head><title>Mes révisions</title></head>
<body>
    <h1>Révisions</h1>
    <table border="1">
        <tr>
            <th>Matière</th>
            <th>Durée</th>
            <th>Note</th>
            <th>Date</th>
            <th>Supprimer</th>
        </tr>
        <?php foreach ($revisions as $revision): ?>
            <tr>
                
                    <form method="POST" action="delete_revision.php">
                    <td><input name="id" type="text" value="<?php echo $revision['id']; ?>"></td>
                <td><input type="text" value="<?php echo $revision['matiere']; ?>"></td>
                <td><input type="text" value="<?php echo $revision['duree']; ?>"></td>
                <td><input type="text" value="<?php echo $revision['note']; ?>"></td>
                
                <td><?php echo date('d/m/Y', strtotime($revision['date'])); ?></td>
                <td>
                        <input type="hidden" name="id" value="<?php echo $revision['id']; ?>">
                        <button type="submit" name="Supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>