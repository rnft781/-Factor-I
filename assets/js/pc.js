document.addEventListener('DOMContentLoaded', () => {
    console.log("Chargement du script PC...");

    /* ============================================================
       1. LOGIQUE POPUP & SÉCURITÉ FORMULAIRE
       ============================================================ */
    const sendBtn = document.getElementById('btn-send-form');
    const cookiePopup = document.getElementById('cookie-popup');
    const acceptBtn = document.getElementById('accept-cookies-btn');
    const msgBloque = document.getElementById('msg-bloque');

    // Fonction pour tout débloquer
    function unlockForm() {
        if (sendBtn) {
            sendBtn.disabled = false;
            sendBtn.style.cursor = 'pointer';
            sendBtn.style.opacity = '1';
        }
        if (cookiePopup) cookiePopup.style.display = 'none';
        if (msgBloque) msgBloque.style.display = 'none';
    }

    // Fonction pour bloquer (Afficher le popup)
    function lockForm() {
        if (sendBtn) sendBtn.disabled = true;
        // On affiche le popup en Flex pour le centrer
        if (cookiePopup) cookiePopup.style.display = 'flex';
        if (msgBloque) msgBloque.style.display = 'block';
    }

    // Vérification au chargement de la page
    if (localStorage.getItem('cookieConsent') === 'true') {
        unlockForm(); // Déjà accepté
    } else {
        lockForm(); // Pas encore accepté
    }

    // Action au clic sur le bouton "J'accepte" du Popup
    if (acceptBtn) {
        acceptBtn.addEventListener('click', () => {
            localStorage.setItem('cookieConsent', 'true');
            unlockForm();
        });
    }

    /* ============================================================
       2. LOGIQUE D'AFFICHAGE DYNAMIQUE (GAMING / OFFICE / MULTIMEDIA)
       ============================================================ */
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

    const btns = document.querySelectorAll('.profile-btn');
    const displayArea = document.getElementById('config-area');

    // Fonction d'affichage
    function showProfile(key) {
        if (!profiles[key]) return; // Sécurité

        const data = profiles[key];
        let listHTML = "";
        data.benefits.forEach(b => {
            listHTML += `<li><i class="fas fa-check"></i> ${b}</li>`;
        });

        if (displayArea) {
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
    }

    // Écouteurs sur les boutons (Gaming, Bureautique...)
    if (btns.length > 0) {
        btns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Retirer la classe active de tous les boutons
                btns.forEach(b => b.classList.remove('active'));
                // Ajouter au bouton cliqué
                btn.classList.add('active');
                
                const key = btn.getAttribute('data-profile');
                showProfile(key);
            });
        });

        // Afficher le premier profil par défaut au chargement
        showProfile('gaming');
    }
});