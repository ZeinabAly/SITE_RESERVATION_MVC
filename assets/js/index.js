// FAIRE JOUER PLUSIEURS IMAGES

// let images = document.querySelectorAll('.imagesdefil');
// let currentIndex = 0;

// function showImage(index) {
//     images.forEach((img, i) => {
//         img.style.display = (i === index) ? 'block' : 'none';
//     });
// }
// function nextImage() {
//     currentIndex = (currentIndex + 1) % ImageImages.length;
//     showImage(currentIndex);
// }
// setInterval(nextImage, 3000); // Changer d'image toutes les 3 secondes
// showImage(currentIndex);

// FIN DEFILEMENT IMAGES

//2- CREER UN CARROUSEL POUR LES ACTIVITES ET EXCURSIONS AVEC DES IMAGES SUPPERPOSEES

// LES IMAGES DOIVENT CHANGER DE PLACE POUR PASSER AU MILIEU ETRE PLUS GRANDES
let activityImages = document.querySelectorAll('.activity_img');
let activityIndex = 0;

// function showActivity(index) {
//   activityImages.forEach((img, i) => {
//     img.className = 'activity_img'; // reset
//     let pos = (i - index + activityImages.length) % activityImages.length;
//     let idImgPrincipale = Math.floor(activityImages.length / 2);
//     pos = (pos + idImgPrincipale) % activityImages.length;

//     if (pos === 0) img.classList.add('center');       // image active
//     else if (pos === 1 || pos === activityImages.length-1) img.classList.add('level2'); // juste à côté
//     else if (pos === 2 || pos === activityImages.length-2) img.classList.add('level3'); // un peu plus loin
//     else img.classList.add('level4'); // les plus éloignées
//   });
// }

// function nextActivity() {
//   activityIndex = (activityIndex + 1) % activityImages.length;
//   showActivity(activityIndex);
// }

// setInterval(nextActivity, 4000);
// showActivity(activityIndex);


let nbreImages = activityImages.length;
activityImages[0].classList.add('level4');
activityImages[nbreImages - 1].classList.add('level4');
activityImages[1].classList.add('level3');
activityImages[nbreImages - 2].classList.add('level3');
activityImages[2].classList.add('level2');
activityImages[nbreImages - 3].classList.add('level2');
activityImages[3].classList.add('center');


function rotateActivities() {
    // Les images et les niveaux defilent, la carte d'image qui est au centre passe a un niveau inferieur et celle qui la precedait la remplace directement, ainsi de suite jusque ce qu'elle fasse le tour complet et revient a sa position de debut, jusquà l'infini
    // De la gauche vers la droite, l'objectif est qu'il ait toujours une image au centre
    
    // FAIRE DEPLACER LES NIVEAUX
    // L'image dimunue de niveau et d'indice 
    activityImages.forEach((img) => {
        if (img.classList.contains('center')) {
            img.classList.remove('center');
            img.classList.add('level2');
        } else if (img.classList.contains('level2')) {
            img.classList.remove('level2');
            img.classList.add('level3');
        } else if (img.classList.contains('level3')) {
            img.classList.remove('level3');
            img.classList.add('level4');
        } else if (img.classList.contains('level4')) {
            img.classList.remove('level4');
            img.classList.add('center');
        }
    });

}
// Lancer la rotation toutes les 4 secondes
// setInterval(rotateActivities, 4000);





// FIN CARROUSEL ACTIVITES ET EXCURSIONS

// AJOUTER DES EFFETS HOVER SUR LES IMAGES DES SITES DANS LA SECTION 2

// AJOUTER UN COMPOSANT DE FILTRAGE POUR LES SITES PAR CATEGORIE OU LOCALISATION
// INTEGRER UN BANDEAU DE BIENVENUE DYNAMIQUE AVEC UN TEXTE QUI CHANGE

// OPTIMISER LA MISE EN PAGE POUR LES ECRANS MOBILES
// AJOUTER DES ANIMATIONS DOUCES LORS DU DEFILEMENT DE LA PAGE
// INTEGRER UNE CARTE INTERACTIVE POUR LOCALISER LES SITES
// AJOUTER UN FORMULAIRE DE RESERVATION AVEC VALIDATION EN JAVASCRIPT
// UTILISER DES VARIABLES CSS POUR GERER LES COULEURS ET LES FONTS
// AJOUTER UN FOOTER AVEC DES LIENS VERS LES RESEAUX SOCIAUX ET LES INFORMATIONS DE CONTACT

// FAIRE DISPARAITRE LE TOPHEAD AU SCROLL 
let topHead = document.querySelector('.tophead');
let navigation = document.querySelector('.logo_navs');

window.addEventListener("scroll", function(){
    if(window.scrollY > 50){
        topHead.classList.add('tophead_hidden');
        navigation.classList.add('navigation_fixed');
    }
    else{
        topHead.classList.remove('tophead_hidden');
        navigation.classList.remove('navigation_fixed');
    }
});

// LE MENU BURGER POUR LA NAVIGATION SUR MOBILE
let menuToggle = document.getElementById('menu_toggle');
let navLinks = document.querySelector('.navlinks');
let navpecrans = document.querySelector('.navpecrans');

menuToggle.addEventListener("click", function(){
    if(navpecrans.classList.contains("hidden")){
        navpecrans.classList.remove("hidden");
    }else{
        navpecrans.classList.add("hidden");
    }
})