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
        "page" => "crud/index?table=users",
    ],

    "airports" => [
        "name" => "Aéroports",
        "icon" => "<i class='fa-solid fa-plane-departure'></i>",
        "page" => "crud/index?table=airports",
    ],

    "airlines" => [
        "name" => "Compagnies aériennes",
        "icon" => "<i class='fa-solid fa-plane'></i>",
        "page" => "crud/index?table=airlines",
    ],

    "flights" => [
        "name" => "Vols",
        "icon" => "<i class='fa-solid fa-plane-up'></i>",
        "page" => "crud/index?table=flights",
    ],

    "hotels" => [
        "name" => "Hôtels",
        "icon" => "<i class='fa-solid fa-hotel'></i>",
        "page" => "crud/index?table=hotels",
    ],

    "rooms" => [
        "name" => "Chambres",
        "icon" => "<i class='fa-solid fa-bed'></i>",
        "page" => "crud/index?table=rooms",
    ],

    "activities" => [
        "name" => "Activités",
        "icon" => "<i class='fa-solid fa-person-running'></i>",
        "page" => "crud/index?table=activities",
    ],

    "calendar" => [
        "name" => "Calendrier",
        "icon" => "<i class='fa-solid fa-calendar-days'></i>",
        "page" => "users/index",
    ],

    "reservations" => [
        "name" => "Réservations",
        "icon" => "<i class='fa-solid fa-ticket'></i>",
        "page" => "crud/index?table=reservations",
    ],

    "transactions" => [
        "name" => "Transactions",
        "icon" => "<i class='fa-solid fa-arrow-right-arrow-left'></i>",
        "page" => "crud/index?table=transactions",
    ],

    "payments" => [
        "name" => "Paiements",
        "icon" => "<i class='fa-solid fa-credit-card'></i>",
        "page" => "crud/index?table=paymentss",
    ],

    "reviews" => [
        "name" => "Avis",
        "icon" => "<i class='fa-solid fa-star'></i>",
        "page" => "crud/index?table=reviews",
    ],

    "images" => [
        "name" => "Images",
        "icon" => "<i class='fa-solid fa-image'></i>",
        "page" => "crud/index?table=images",
    ],

    "settings" => [
        "name" => "Paramètres",
        "icon" => "<i class='fa-solid fa-gear'></i>",
        "page" => "users/index",
    ],
];