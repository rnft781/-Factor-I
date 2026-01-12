// On ajoute un message dans la console pour être sûr que le fichier se charge
console.log("Le fichier mib.js est bien chargé !");

document.addEventListener('DOMContentLoaded', () => {
    
    // --- DEBUGGING ---
    const textElement = document.getElementById('typing-text');
    console.log("Element trouvé ?", textElement); // Doit afficher l'élément dans la console (F12)

    if (textElement) {
        // 1. On force le style pour être sûr que ce soit visible (Blanc)
        textElement.style.color = "#ffffff";
        textElement.style.minHeight = "50px"; // Pour éviter que ça saute

        // 2. Texte SANS ACCENT pour éviter tout bug d'encodage pour l'instant
        const textToType = "Securisez vos Emails."; 
        let charIndex = 0;

        // 3. On vide le contenu initial
        textElement.innerHTML = '';

        function typeWriter() {
            if (charIndex < textToType.length) {
                // On ajoute la lettre
                textElement.innerHTML += textToType.charAt(charIndex);
                charIndex++;
                // On continue
                setTimeout(typeWriter, 100);
            } else {
                // Fin : on ajoute le curseur
                textElement.innerHTML += '<span class="cursor" style="display:inline-block; width:3px; height:20px; background:red; margin-left:5px;"></span>';
                console.log("Animation terminée.");
            }
        }

        // Démarrage immédiat
        console.log("Démarrage de l'animation...");
        typeWriter();
    } else {
        console.error("ERREUR : Impossible de trouver <h1 id='typing-text'> dans la page.");
    }

    // --- LE RESTE DU CODE (ONGLETS ETC...) ---
    // (Tu peux laisser ton code d'onglets ici si tu veux qu'il marche aussi)
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    if(tabBtns.length > 0) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                btn.classList.add('active');
                const target = document.getElementById(btn.getAttribute('data-tab'));
                if(target) target.classList.add('active');
            });
        });
    }
});