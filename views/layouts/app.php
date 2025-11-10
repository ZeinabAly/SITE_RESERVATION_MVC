<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mon site MVC' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <header>
        <h1>Mon Site MVC</h1>
        <?= include "views/layouts/navigation.php"; ?>
    </header>

    <main>
        <!-- Contenu spécifique à chaque page -->
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> - Tous droits réservés</p>
    </footer>
</body>
</html>
