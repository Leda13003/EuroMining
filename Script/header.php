<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digitf</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/orders.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Euro Mining</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#wewewe">Nos produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contactation">Contactez-nous</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="Checkout.php">Panier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vente.php">Vente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">Commandes en cours</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.html">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Contenu principal de la page -->
</body>
</html>
