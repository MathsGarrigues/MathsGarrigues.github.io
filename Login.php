<?php
// Informations de connexion à la base de données ElephantSQL
$host = 'trumpet';
$port = 'votre_port_elephantsql';
$dbname = 'ufukuhig';
$user = 'ufukuhig';
$password = 'txvfeQ3bfVRAv2U0TnxMu-GEiuVxpqP-';

// Chaîne de connexion PDO
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    // Créer une connexion PDO à la base de données
    $pdo = new PDO($dsn);

    // Configuration supplémentaire de PDO si nécessaire
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Utiliser $pdo pour exécuter des requêtes SQL ou interagir avec la base de données
    // Par exemple :
    // $pdo->query("SELECT * FROM ma_table");

} catch (PDOException $e) {
    // Gérer les erreurs de connexion
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>