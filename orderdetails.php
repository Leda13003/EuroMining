<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include './Script/config.php';

if (!isset($_GET['order_id'])) {
    echo "ID de commande non fourni.";
    exit();
}

$order_id = $_GET['order_id'];
$sql = "SELECT * FROM order_items WHERE order_id = '$order_id'";
$result = $conn->query($sql);
$order_items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $order_items[] = $row;
    }
}

$order_sql = "SELECT * FROM orders WHERE id = '$order_id'";
$order_result = $conn->query($order_sql);
$order = $order_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Commande - Euro Mining</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/orders.css" />
</head>
<body>
    <?php include './Script/header.php'; ?>
    <div class="container">
        <div class="order-details-wrapper">
            <h1>Détails de la Commande #<?php echo $order_id; ?></h1>
            <h3>Date: <?php echo $order['created_at']; ?></h3>
            <h3>Total: <?php echo $order['total']; ?>€</h3>
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
                </tbody>
            </table>
            <a href="order.php" class="btn btn-primary">Retour aux commandes</a>
        </div>
    </div>
    <?php include './Script/footer.php'; ?>
</body>
</html>
