<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=sirinesante;port=3306', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
