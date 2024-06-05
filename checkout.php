<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Pour simplifier, nous affichons simplement les produits dans le panier et un message de confirmation
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - Digitf</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
</head>
<body>
<?php
include './Script/header.php';

?>

    <div class="container">
        <div class="heading_container">
            <h2>Votre Commande</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach ($_SESSION['cart'] as $product): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo htmlspecialchars($product['price']); ?>€</td>
                                </tr>
                                <?php $total += $product['price']; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong><?php echo $total; ?>€</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <form method="POST" action="./Script/confirmer.php">
                            <button type="submit" class="btn btn-success">Confirmer la commande</button>
                        </form>
                    </div>
                <?php else: ?>
                    <p>Votre panier est vide.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
