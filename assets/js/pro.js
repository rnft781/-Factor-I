document.addEventListener('DOMContentLoaded', () => {

    // 1. LES DONNÉES (Le contenu de chaque service)
    const servicesData = {
        maintenance: {
            title: "Maintenance & Infogérance",
            desc: "Une panne informatique peut avoir de lourdes répercussions. Nous anticipons les problèmes avant qu'ils n'arrivent.",
            list: [
                "Préventif : Mises à jour et surveillance des serveurs.",
                "Curatif : Intervention rapide sur site ou à distance.",
                "Budget maîtrisé : Forfaits ajustés à votre parc."
            ],
            cta: "Demander un contrat",
            imgClass: "maintenance-img"
        },
        sauvegarde: {
            title: "Solutions de Sauvegarde",
            desc: "Vos données sont votre capital le plus précieux. Incendie, vol, ransomware... Êtes-vous prêt à tout perdre ?",
            list: [
                "Sauvegarde 3-2-1 : Locale et Cloud cryptée.",
                "Plan de Reprise d'Activité (PRA) inclus.",
                "Tests de restauration réguliers pour garantir l'intégrité."
            ],
            cta: "Auditer mes sauvegardes",
            imgClass: "sauvegarde-img"
        },
        conseil: {
            title: "Conseil & Accompagnement",
            desc: "Ne choisissez pas votre matériel au hasard. Nous analysons vos besoins pour optimiser vos investissements.",
            list: [
                "Audit complet de votre infrastructure actuelle.",
                "Conseils stratégiques pour le renouvellement de parc.",
                "Sécurisation de vos réseaux et accès distants."
            ],
            cta: "Prendre RDV avec un expert",
            imgClass: "conseil-img"
        }
    };

    // 2. LA LOGIQUE
    const buttons = document.querySelectorAll('.svc-btn');
    const displayArea = document.getElementById('display-area');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            
            // A. Gestion des boutons (Actif / Inactif)
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // B. Récupération des données
            const target = btn.getAttribute('data-target'); // ex: 'sauvegarde'
            const data = servicesData[target];

            // C. Construction du HTML dynamique
            // On génère la liste <li> proprement
            let listHTML = "";
            data.list.forEach(item => {
                listHTML += `<li><i class="fas fa-check-circle"></i> <strong>${item.split(':')[0]}</strong>${item.includes(':') ? item.split(':')[1] : ''}</li>`;
            });

            // D. Injection du nouveau contenu avec animation
            displayArea.innerHTML = `
                <div class="display-content fade-in">
                    <div class="text-col">
                        <h2>${data.title}</h2>
                        <p class="lead">${data.desc}</p>
                        <ul class="pro-list">
                            ${listHTML}
                        </ul>
                        <a href="contact.html" class="btn btn-primary">${data.cta}</a>
                    </div>
                    <div class="img-col">
                        <div class="dynamic-img ${data.imgClass}"></div>
                    </div>
                </div>
            `;
        });
    });

});