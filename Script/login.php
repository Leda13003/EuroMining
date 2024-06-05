<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Démarrer la session
            session_start();
            // Enregistrer les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            
            // Rediriger vers la page de la boutique
            header("Location: ../vente.php");
            exit(); // Assurez-vous d'appeler exit après header pour arrêter l'exécution
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
    $conn->close();
}
?>
