<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include './Script/config.php';

// Récupérer les commandes de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
$orders = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes en Cours - Euro Mining</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/orders.css" />
</head>
<body>
    <?php include './Script/header.php'; ?>
    <div class="container">
        <div class="orders-wrapper">
            <h1>Commandes en Cours</h1>
            <?php if (!empty($orders)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Commande</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo $order['total']; ?>€</td>
                                <td><a href="orderdetails.php?order_id=<?php echo $order['id']; ?>" class="btn btn-info">Voir Détails</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Vous n'avez aucune commande en cours.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php include './Script/footer.php'; ?>
</body>
</html>
