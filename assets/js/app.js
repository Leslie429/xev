// 1. Importation des modules en haut du fichier
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';

// 2. Exécution après le chargement du DOM
document.addEventListener("DOMContentLoaded", function () {
    // Initialisation du menu burger
    const burgerMenu = document.querySelector(".burger-menu");
    const navLinks = document.querySelector(".nav-links");

    if (burgerMenu && navLinks) {
        burgerMenu.addEventListener("click", function () {
            navLinks.classList.toggle("show");
        });
    }

    // 3. Initialisation du Swiper pour le slider principal
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper('.swiper-container', {
            loop: true,
            autoplay: { delay: 5000 },  // Changer d'image toutes les 5 secondes
            slidesPerView: 1,  // Une seule image visible à la fois
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            effect: 'fade', // Effet de fondu entre les slides
            speed: 800, // Durée de la transition entre les slides
        });
    });
    

    // 4. Initialisation du Swiper pour les avis clients
    if (document.querySelector(".reviews-swiper")) {
        new Swiper('.reviews-swiper', {
            loop: true,
            autoplay: { delay: 3000 },
            pagination: { el: '.swiper-pagination', clickable: true },
        });
    }
});
