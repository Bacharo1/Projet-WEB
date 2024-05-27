<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "marimoun", "marimoun", "pays_database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nom_pays = $_POST['nom_pays'];
$volume_ventes = $_POST['volume_ventes'];
$revenu = $_POST['revenu'];
$profit = $_POST['profit'];
$marge_profit = $_POST['marge_profit'];
$produit_principal = $_POST['produit_principal'];

$sql = "INSERT INTO pays (nom_pays, volume_ventes, revenu, profit, marge_profit, produit_principal)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siidss", $nom_pays, $volume_ventes, $revenu, $profit, $marge_profit, $produit_principal);

if ($stmt->execute()) {
    echo "Nouveau pays ajouté avec succès.";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
