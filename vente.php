<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include './Script/config.php';

// Ajouter un produit au panier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Vérifier si le panier existe dans la session, sinon le créer
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Ajouter le produit au panier
    $_SESSION['cart'][] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price
    ];

    header("Location: vente.php");
    exit();
}

// Supprimer un produit du panier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_product_id'])) {
    $remove_product_id = $_POST['remove_product_id'];

    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['id'] == $remove_product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    header("Location: vente.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits en vente - Euro Mining</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
</head>
<body>
    <?php include './Script/header.php'; ?>
    <div class="container">
        <div class="heading_container">
            <h2>Produits en vente</h2>
            <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
        </div>
        <div class="row">
            <!-- Produit 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/S21.png" class="card-img-top" alt="BitMain Hydro S21">
                    <div class="card-body">
                        <h5 class="card-title">BitMain Hydro S21</h5>
                        <p class="card-text">Asic - Haute performance pour le minage de cryptomonnaies.</p>
                        <p class="card-text">Prix: 9500€</p>
                        <form method="POST" action="vente.php">
                            <input type="hidden" name="product_id" value="1">
                            <input type="hidden" name="product_name" value="BitMain Hydro S21">
                            <input type="hidden" name="product_price" value="9500">
                            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Produit 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/IKSMAX.png" class="card-img-top" alt="IBelink KSMAX">
                    <div class="card-body">
                        <h5 class="card-title">IBelink KSMAX</h5>
                        <p class="card-text">Asic - Machine performante pour le minage de Kaspa.</p>
                        <p class="card-text">Prix: 20000€</p>
                        <form method="POST" action="vente.php">
                            <input type="hidden" name="product_id" value="2">
                            <input type="hidden" name="product_name" value="IBelink KSMAX">
                            <input type="hidden" name="product_price" value="20000">
                            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Produit 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/1N.png" class="card-img-top" alt="NVidia RTX 4090">
                    <div class="card-body">
                        <h5 class="card-title">NVidia RTX 4090</h5>
                        <p class="card-text">Carte graphique - Parfait pour les gamers et les mineurs.</p>
                        <p class="card-text">Prix: 1500€</p>
                        <form method="POST" action="vente.php">
                            <input type="hidden" name="product_id" value="3">
                            <input type="hidden" name="product_name" value="NVidia RTX 4090">
                            <input type="hidden" name="product_price" value="1500">
                            <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="heading_container mt-5">
            <h2>Votre Panier</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $product): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo htmlspecialchars($product['price']); ?>€</td>
                                    <td>
                                        <form method="POST" action="vente.php">
                                            <input type="hidden" name="remove_product_id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Retirer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a href="checkout.php" class="btn btn-success">Passer à la caisse</a>
                    </div>
                <?php else: ?>
                    <p>Votre panier est vide.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include './Script/footer.php'; ?>
</body>
</html>
