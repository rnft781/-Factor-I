document.addEventListener('DOMContentLoaded', () => {

    // ==============================================
    // GESTION DE L'ACCORDÉON
    // ==============================================
    const accordions = document.querySelectorAll('.accordion-item');

    accordions.forEach(item => {
        const header = item.querySelector('.accordion-header');
        
        header.addEventListener('click', () => {
            // A. Est-ce que cet élément est déjà ouvert ?
            const isOpen = item.classList.contains('active');

            // B. On ferme TOUS les autres éléments
            accordions.forEach(otherItem => {
                otherItem.classList.remove('active');
                otherItem.querySelector('.accordion-body').style.maxHeight = null;
            });

            // C. Si celui cliqué n'était pas ouvert, on l'ouvre
            if (!isOpen) {
                item.classList.add('active');
                const body = item.querySelector('.accordion-body');
                // Hauteur dynamique selon le texte
                body.style.maxHeight = body.scrollHeight + "px";
            }
        });
    });

});