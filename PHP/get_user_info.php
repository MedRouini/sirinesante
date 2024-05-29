<?php
include 'init_connect.php';
session_start();

$user_id = $_SESSION['user_id'];

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    try {
        if ($user_type === 'patient') {
            $stmt = $dbh->prepare("SELECT Nom, Prenom, Date_Naissance FROM PATIENT WHERE id_patient = ?");
        } elseif ($user_type === 'medecin') {
            $stmt = $dbh->prepare("SELECT Nom, Prenom, Date_Naissance FROM MEDECIN WHERE id_medecin = ?");
        } else {
            echo json_encode(["error" => "Type d'utilisateur inconnu."]);
            exit;
        }

        $stmt->execute([$user_id]);
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_info) {
            echo json_encode($user_info);
        } else {
            echo json_encode(["error" => "Utilisateur non trouvé."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Erreur : " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "L'utilisateur n'est pas connecté."]);
}