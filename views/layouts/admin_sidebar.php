<?php 
    include_once "./config/adminSideRoutes.php";
    $routes = ADMIN_SIDEBAR_ROUTES;
?>

<!-- Overlay -->
<!-- <div id="sidebarOverlay" class="sidebar-overlay"></div> -->

<div class="admin_sidebar " id="adminSidebar">
    <div class="logo">
        <img src="./assets/images/logo.png" class="logoAdSideBar" alt="logo de l'application">
    </div>
    <div class="">
        <?php foreach($routes as $route): ?>
            <div class="each_route" data-title="<?= $route['name'] ?>" data-page="<?= $route['page'] ?>">
                <?= $route['icon'] ?>
                <p class="name"><?= $route['name'] ?></p>
            </div>
        <?php endforeach?>
    </div>
</div>

