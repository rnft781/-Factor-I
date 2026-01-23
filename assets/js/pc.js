document.addEventListener('DOMContentLoaded', () => {

    // DONNEES : EXEMPLES DE PROJETS (Pas de specs fixes)
    const profiles = {
        gaming: {
            title: "Projet Gaming",
            desc: "Que vous soyez joueur occasionnel ou compétiteur e-sport, nous trouvons l'équilibre entre fluidité (FPS) et qualité graphique.",
            benefits: [
                "Choix de la carte graphique selon VOS jeux.",
                "Optimisation du refroidissement pour le silence.",
                "Esthétique personnalisable (Boîtier, LED...)."
            ],
            priceRange: "Budget moyen constaté : Entre 1000€ et 2500€",
            bgClass: "gaming-bg"
        },
        office: {
            title: "Projet Bureautique",
            desc: "Un ordinateur conçu pour durer, démarrer en quelques secondes et gérer tous vos logiciels sans ralentissement.",
            benefits: [
                "Composants fiables et durables.",
                "Boîtier compact et silencieux.",
                "Rapidité de démarrage (SSD inclus)."
            ],
            priceRange: "Budget moyen constaté : Entre 500€ et 900€",
            bgClass: "office-bg"
        },
        multimedia: {
            title: "Projet Multimédia / Création",
            desc: "Pour le montage vidéo, la retouche photo ou la 3D. Une puissance de calcul brute adaptée à vos logiciels professionnels.",
            benefits: [
                "Processeur puissant pour les calculs lourds.",
                "Grande quantité de mémoire (RAM).",
                "Stockage rapide et sécurisé pour vos fichiers."
            ],
            priceRange: "Budget moyen constaté : Sur devis uniquement",
            bgClass: "multimedia-bg"
        }
    };

    // LOGIQUE D'AFFICHAGE DYNAMIQUE
    const btns = document.querySelectorAll('.profile-btn');
    const displayArea = document.getElementById('config-area');

    // Fonction pour afficher le contenu
    function showProfile(key) {
        const data = profiles[key];

        // Création de la liste des avantages
        let listHTML = "";
        data.benefits.forEach(b => {
            listHTML += `<li><i class="fas fa-check"></i> ${b}</li>`;
        });

        // Injection HTML
        displayArea.innerHTML = `
            <div class="config-content fade-in">
                <div class="config-text">
                    <h3>${data.title}</h3>
                    <p>${data.desc}</p>
                    <ul class="benefits-list">
                        ${listHTML}
                    </ul>
                    <div class="price-range">
                        <i class="fas fa-wallet"></i> ${data.priceRange}
                    </div>
                </div>
                <div class="config-visual ${data.bgClass}"></div>
            </div>
        `;
    }

    // Gestion des clics sur les boutons
    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Retirer la classe active partout
            btns.forEach(b => b.classList.remove('active'));
            // Ajouter active au bouton cliqué
            btn.classList.add('active');
            
            // Afficher le contenu
            const key = btn.getAttribute('data-profile');
            showProfile(key);
        });
    });

    // Afficher le premier profil (Gaming) au chargement de la page
    showProfile('gaming');


    // GESTION ENVOI FORMULAIRE (Simulation)
    const form = document.getElementById('projectForm');
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // Empêche le rechargement
            alert("Merci ! Votre demande de projet a bien été envoyée à l'équipe Factor-I. Nous vous recontactons très vite.");
            form.reset(); // Vide le formulaire
        });
    }

});