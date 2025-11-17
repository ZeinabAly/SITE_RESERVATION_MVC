<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mon site MVC' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- POUR LE COMPOSANT FILTRE TAILWIND QUE J'AI IMPORTE -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</head>
<body>
    
    <!-- HEADER -->
    <?php include_once "views/partials/_header.php"; ?>

    <!-- MAIN -->
    <main>
        <!-- Contenu spécifique à chaque page -->
        <!-- <?php $content ?> -->
        <?php include "views/pages/$view.php"; ?>
    </main>

    <!-- FOOTER -->
    <?php include_once "views/partials/_footer.php"; ?>
    
    <script src="./assets/js/index.js"></script>
</body>
</html>
