<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Vérifier si le panier est vide
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Votre panier est vide.";
    exit();
}

// Calculer le total de la commande
$total = 0;
foreach ($_SESSION['cart'] as $product) {
    $total += $product['price'];
}

// Insérer la commande dans la table orders
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO orders (user_id, total) VALUES ('$user_id', '$total')";
if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id;

    // Insérer les articles de la commande dans la table order_items
    foreach ($_SESSION['cart'] as $product) {
        $product_name = $product['name'];
        $product_price = $product['price'];
        $sql = "INSERT INTO order_items (order_id, product_name, product_price) VALUES ('$order_id', '$product_name', '$product_price')";
        $conn->query($sql);
    }

    // Récupérer les détails de la commande
    $sql = "SELECT * FROM order_items WHERE order_id = '$order_id'";
    $result = $conn->query($sql);
    $order_items = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $order_items[] = $row;
        }
    }

    // Vider le panier
    unset($_SESSION['cart']);
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Commande - Euro Mining</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/confirmation.css" />
</head>
<body>
    <div class="container">
        <div class="confirmation-wrapper">
            <h1>Merci pour votre achat, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <h2>Votre commande a été confirmée.</h2>
            <h3>Récapitulatif de la commande :</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($item['product_price']); ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong><?php echo $total; ?>€</strong></td>
                    </tr>
                </tbody>
            </table>
            <a href="../vente.php" class="btn btn-primary">Retour à la boutique</a>
        </div>
    </div>
</body>
</html>
