<?php
include_once 'init_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = htmlspecialchars($_POST["id_user"]);
    $user_type = htmlspecialchars($_POST["user_type"]);
    $password = htmlspecialchars($_POST["password"]);

    try {
        if ($user_type === 'patient') {
            $sql = "SELECT * FROM PATIENT WHERE id_patient = :id_user";
        } else if ($user_type === 'medecin') {
            $sql = "SELECT * FROM MEDECIN WHERE id_medecin = :id_user";
        } else {
            echo "Invalid user type";
            exit;
        }

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $hashed_password = hash('sha256', $password);
            if ($hashed_password === $result['password']) {
                $_SESSION['user_id'] = $user_type === 'patient' ? $result['id_patient'] : $result['id_medecin'];
                $_SESSION['user_type'] = $user_type;

                header('Location: ../HTML/onglets.html');
                exit;
            } else {
                echo "Invalid password";
            }
        } else {
            echo "No user found with this ID";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}