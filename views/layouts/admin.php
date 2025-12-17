<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin Dashboard' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <div class="adminDash">
        <?php include_once "./views/layouts/admin_topbar.php" ?>
        <!-- TOPBAR -->
        <div class="sidebar_mainContent">
            <!-- SIDEBAR -->
            <div class="">
                <?php include_once "./views/layouts/admin_sidebar.php" ?> 
            </div>
            
            <!-- MAIN CONTENT -->
            <!-- Contenu spécifique à chaque page -->
            <main class="mainContent" id="mainContent">
                
            </main>
        </div>
    </div>
    
    <!-- module pour charger les imports -->
    <script type="module" src="./assets/js/adminDash.js"></script>
</body>
</html>
