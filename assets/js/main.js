// Attendre que tout le HTML soit chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', () => {
    
    // --- GESTION DU MENU MOBILE (BURGER) ---
    const burgerMenu = document.getElementById('burger-menu');
    const navList = document.querySelector('.nav-list');

    // Quand on clique sur l'icône burger
    burgerMenu.addEventListener('click', () => {
        // On ajoute ou enlève la classe 'active' à la liste de navigation
        // Si elle est là, le CSS (ligne 260 environ) affiche le menu
        navList.classList.toggle('active');
    });

    // --- GESTION DES SOUS-MENUS SUR MOBILE ---
    // Sur mobile, cliquer sur "Pour le professionnel" doit ouvrir le sous-menu
    // au lieu de ne rien faire.
    const dropdowns = document.querySelectorAll('.dropdown > a');

    dropdowns.forEach(link => {
        link.addEventListener('click', (e) => {
            // On vérifie si on est sur un petit écran (moins de 768px)
            if (window.innerWidth <= 768) {
                e.preventDefault(); // Empêche le lien de recharger la page
                
                // On trouve le sous-menu (le frère suivant dans le HTML)
                const submenu = link.nextElementSibling;
                
                // On l'affiche ou on le cache
                if (submenu.style.display === "block") {
                    submenu.style.display = "none";
                } else {
                    submenu.style.display = "block";
                }
            }
        });
    });

    // --- PETIT EFFET SCROLL (Optionnel) ---
    // Change l'ombre du header quand on descend dans la page
    const header = document.querySelector('.main-header');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.boxShadow = "0 4px 15px rgba(0,0,0,0.2)";
        } else {
            header.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
        }
    });

});