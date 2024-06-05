<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
