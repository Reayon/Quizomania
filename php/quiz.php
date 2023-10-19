<?php
$id = $_GET['ID_kategorii'] ?? null;
if (!$id) {
    header('Location: ../php/stronaGlowna.php');
    exit;
}

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=kategorie', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM kategorie WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$kategoria = $statement->fetch(PDO::FETCH_ASSOC);


?>