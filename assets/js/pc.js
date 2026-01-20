document.addEventListener('DOMContentLoaded', () => {

    // DONNEES DES PROFILS
    const profiles = {
        gaming: {
            title: "Performance Gaming",
            desc: "Jouez aux derniers titres AAA en Ultra sans compromis. Fluidité et graphismes époustouflants.",
            specs: [
                { icon: "microchip", label: "Processeur", val: "Intel i5/i7 ou Ryzen 5/7" },
                { icon: "memory", label: "Carte Graphique", val: "NVIDIA RTX 4060 à 4090" },
                { icon: "bolt", label: "RAM", val: "16 à 32 Go DDR5" },
                { icon: "hdd", label: "Stockage", val: "SSD NVMe 1To Ultra-Rapide" }
            ],
            price: "Budget estimé : Dès 1200€",
            bgClass: "gaming-bg",
            btnText: "Demander un devis Gaming"
        },
        office: {
            title: "Bureautique & Télétravail",
            desc: "Un PC silencieux, rapide au démarrage et parfait pour le multitâche. Fini les lenteurs.",
            specs: [
                { icon: "microchip", label: "Processeur", val: "Intel i3/i5 ou Ryzen 3/5" },
                { icon: "volume-mute", label: "Silence", val: "Boîtier insonorisé" },
                { icon: "bolt", label: "RAM", val: "8 à 16 Go DDR4/DDR5" },
                { icon: "hdd", label: "Stockage", val: "SSD 500Go (Démarrage en 10s)" }
            ],
            price: "Budget estimé : Dès 600€",
            bgClass: "office-bg",
            btnText: "Configurer mon PC Bureau"
        },
        creator: {
            title: "Workstation Créateur 3D/Vidéo",
            desc: "Puissance de calcul brute pour le rendu vidéo, la modélisation 3D ou l'architecture.",
            specs: [
                { icon: "microchip", label: "Processeur", val: "Intel i7/i9 ou Threadripper" },
                { icon: "layer-group", label: "Graphique", val: "RTX 4080 ou NVIDIA Quadro" },
                { icon: "bolt", label: "RAM", val: "32 Go à 128 Go" },
                { icon: "server", label: "Stockage", val: "RAID Sécurisé Multi-Disques" }
            ],
            price: "Budget estimé : Sur devis uniquement",
            bgClass: "creator-bg",
            btnText: "Contacter un expert Pro"
        }
    };

    // LOGIQUE
    const btns = document.querySelectorAll('.profile-btn');
    const displayArea = document.getElementById('config-area');

    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            // 1. Gérer les classes actives
            btns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // 2. Récupérer les données
            const key = btn.getAttribute('data-profile');
            const data = profiles[key];

            // 3. Construire la liste des specs
            let specsHTML = "";
            data.specs.forEach(s => {
                specsHTML += `<li><i class="fas fa-${s.icon}"></i> <strong>${s.label} :</strong> ${s.val}</li>`;
            });

            // 4. Injecter le HTML
            displayArea.innerHTML = `
                <div class="config-content fade-in">
                    <div class="config-text">
                        <h3>${data.title}</h3>
                        <p>${data.desc}</p>
                        <ul class="specs-list">
                            ${specsHTML}
                        </ul>
                        <div class="price-tag">${data.price}</div>
                        <a href="contact.html" class="btn btn-red">${data.btnText}</a>
                    </div>
                    <div class="config-visual ${data.bgClass}"></div>
                </div>
            `;
        });
    });

});