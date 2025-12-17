<?php
// CONTIENT LA LISTE DES ROUTES A AFFICHER DANS LA SIDEBAR DU DASH ADMIN
// PRIERE D'AVOIR ACCES A INTERNET CAR LES ICONES SONT EN LIGNE
// AMELIORATION: SEPARER LES ICONES 

const ADMIN_SIDEBAR_ROUTES = [
    "dashboard" => [
        "name" => "Tableau de bord",
        "icon" => "<i class='fa-solid fa-gauge'></i>",
        "page" => "dashboard",
    ],

    "users" => [
        "name" => "Utilisateurs",
        "icon" => "<i class='fa-solid fa-user'></i>",
        "page" => "users/index",
    ],

    "airports" => [
        "name" => "Aéroports",
        "icon" => "<i class='fa-solid fa-plane-departure'></i>",
        "page" => "users/index",
    ],

    "airlines" => [
        "name" => "Compagnies aériennes",
        "icon" => "<i class='fa-solid fa-plane'></i>",
        "page" => "users/index",
    ],

    "flights" => [
        "name" => "Vols",
        "icon" => "<i class='fa-solid fa-plane-up'></i>",
        "page" => "users/index",
    ],

    "hotels" => [
        "name" => "Hôtels",
        "icon" => "<i class='fa-solid fa-hotel'></i>",
        "page" => "users/index",
    ],

    "rooms" => [
        "name" => "Chambres",
        "icon" => "<i class='fa-solid fa-bed'></i>",
        "page" => "users/index",
    ],

    "activities" => [
        "name" => "Activités",
        "icon" => "<i class='fa-solid fa-person-running'></i>",
        "page" => "users/index",
    ],

    "calendar" => [
        "name" => "Calendrier",
        "icon" => "<i class='fa-solid fa-calendar-days'></i>",
        "page" => "users/index",
    ],

    "reservations" => [
        "name" => "Réservations",
        "icon" => "<i class='fa-solid fa-ticket'></i>",
        "page" => "users/index",
    ],

    "transactions" => [
        "name" => "Transactions",
        "icon" => "<i class='fa-solid fa-arrow-right-arrow-left'></i>",
        "page" => "users/index",
    ],

    "payments" => [
        "name" => "Paiements",
        "icon" => "<i class='fa-solid fa-credit-card'></i>",
        "page" => "users/index",
    ],

    "reviews" => [
        "name" => "Avis",
        "icon" => "<i class='fa-solid fa-star'></i>",
        "page" => "users/index",
    ],

    "images" => [
        "name" => "Images",
        "icon" => "<i class='fa-solid fa-image'></i>",
        "page" => "users/index",
    ],

    "settings" => [
        "name" => "Paramètres",
        "icon" => "<i class='fa-solid fa-gear'></i>",
        "page" => "users/index",
    ],
];