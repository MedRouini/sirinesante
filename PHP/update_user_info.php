<?php
include 'init_connect.php';
session_start();


$user_id = $_SESSION['user_id'];

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];

        try {
            if ($user_type === 'patient') {
                $stmt = $dbh->prepare("UPDATE PATIENT SET Nom = ?, Prenom = ?, Date_Naissance = ? WHERE id_patient = ?");
            } elseif ($user_type === 'medecin') {
                $stmt = $dbh->prepare("UPDATE MEDECIN SET Nom = ?, Prenom = ?, Date_Naissance = ? WHERE id_medecin = ?");
            } else {
                echo json_encode(["error" => "Type d'utilisateur inconnu."]);
                exit;
            }

            $stmt->execute([$nom, $prenom, $date_naissance, $user_id]);

            echo json_encode(["success" => "Informations mises à jour avec succès"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erreur : " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["error" => "Requête invalide"]);
    }
} else {
    echo json_encode(["error" => "L'utilisateur n'est pas connecté."]);
}