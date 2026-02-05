<?php
// --- 1. CONFIGURATION DE LA BASE DE DONNÉES ---
$host = 'localhost'; $user = 'admin'; $pass = 'admin123'; $db = 'formulaire_contact';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Erreur critique : " . $conn->connect_error); }

$status_message = "";

// --- 2. TRAITEMENT DU FORMULAIRE ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Nettoyage des données
    $nom     = $conn->real_escape_string($_POST['nom']);
    $prenom  = $conn->real_escape_string($_POST['prenom']);
    $email   = $conn->real_escape_string($_POST['email']);
    $tel     = $conn->real_escape_string($_POST['tel']);
    $type    = $conn->real_escape_string($_POST['machine_type']);
    $usage   = $conn->real_escape_string($_POST['usage']);
    $details = $conn->real_escape_string($_POST['message']);

    // Enregistrement SQL
    $sql = "INSERT INTO projets_pc (nom, prenom, email, telephone, type_machine, usage_principal, details) 
            VALUES ('$nom', '$prenom', '$email', '$tel', '$type', '$usage', '$details')";

    if ($conn->query($sql) === TRUE) {
        // === LA CORRECTION EST ICI ===
        // On redirige l'utilisateur vers la même page avec un petit paramètre "?success=1"
        // Cela "nettoie" l'envoi du formulaire.
        header("Location: pc-sur-mesure.php?success=1#formulaire-projet");
        exit(); 
    } else {
        $status_message = "<div style='background:#f8d7da; color:#721c24; padding:15px; border-radius:5px; margin-bottom:20px; text-align:center;'>❌ Erreur : " . $conn->error . "</div>";
    }
}

// --- 3. AFFICHAGE DU MESSAGE DE SUCCÈS (APRÈS REDIRECTION) ---
// On regarde si l'URL contient "?success=1"
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $status_message = "<div style='background:#d4edda; color:#155724; padding:15px; border-radius:5px; margin-bottom:20px; text-align:center;'>✅ <strong>Demande reçue !</strong> Nous allons étudier votre projet de PC.</div>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Projet PC sur Mesure | Factor-I</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/pc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header class="main-header">
        <div class="container">
            <a href="index.html" class="logo-link">
                <img src="assets/img/logo.png" alt="Logo Factor-I" class="logo-img">

            </a>

            <nav class="navbar">
                <ul class="nav-list">
                    <li><a href="index.html" class="active">Accueil</a></li>

                    <li class="dropdown">
                        <a href="#">Pour le professionnel <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-content">
                            <li><a href="pour-pro.html">Pour les professionnels</a></li>
                            <li><a href="maintenance.html">Comprendre la maintenance</a></li>
                            <li><a href="sauvegarde.html">Solutions de sauvegarde</a></li>
                            <li><a href="conseil.html">Conseil & Accompagnement</a></li>
                            <li><a href="mail-in-black.html">Mail in Black</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#">Nos services Informatique <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-content">
                            <li><a href="assistance.html">Assistance Particulier</a></li>
                            <li><a href="reparation.html">Réparation / Atelier</a></li>
                            <li><a href="sav-pc.html">SAV PC</a></li>
                            <li><a href="pc-sur-mesure.php">PC sur mesure</a></li>
                            <li><a href="occasion.html">Occasion</a></li>
                            <li><a href="sav-apple.html">SAV Apple</a></li>
                        </ul>
                    </li>

                    <li><a href="contact.html" class="btn-contact">Contact</a></li>
                </ul>
            </nav>

            <div class="burger-menu" id="burger-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>


    <main>
        <section class="pc-hero">
            <div class="container">
                <div class="pc-hero-content">
                    <h1>Imaginons votre PC <br><span class="text-red">Ensemble</span></h1>
                    <p>Ne choisissez pas un ordinateur au hasard. Discutons de vos besoins.</p>
                </div>
            </div>
        </section>

        <section class="section-padding bg-dark">
            <div class="container">
                <h2 class="section-title white-title">Quel est votre objectif ?</h2>
                <div class="profile-selector">
                    <button class="profile-btn active" data-profile="gaming"><i class="fas fa-gamepad"></i> <span>Gaming</span></button>
                    <button class="profile-btn" data-profile="office"><i class="fas fa-laptop"></i> <span>Bureautique</span></button>
                    <button class="profile-btn" data-profile="multimedia"><i class="fas fa-photo-video"></i> <span>Multimédia</span></button>
                </div>
                <div class="config-display" id="config-area"></div>
            </div>
        </section>

        <section id="formulaire-projet" class="section-padding">
            <div class="container">
                <div class="form-wrapper">
                    <div class="form-intro">
                        <h2>Définissons votre besoin</h2>
                        <?php echo $status_message; ?>
                    </div>

                    <form class="project-form" id="projectForm" method="POST" action="">
                        <div class="form-row">
                            <div class="form-group"><label>Nom</label><input type="text" name="nom" required></div>
                            <div class="form-group"><label>Prénom</label><input type="text" name="prenom" required></div>
                        </div>
                        <div class="form-row">
                            <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
                            <div class="form-group"><label>Téléphone</label><input type="tel" name="tel" required></div>
                        </div>

                        <div class="form-group">
                            <label class="label-title">Type de machine</label>
                            <div class="radio-options">
                                <label class="radio-card">
                                    <input type="radio" name="machine_type" value="tour" checked>
                                    <span class="radio-visual"><i class="fas fa-desktop"></i><span>Tour</span></span>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="machine_type" value="portable">
                                    <span class="radio-visual"><i class="fas fa-laptop"></i><span>Portable</span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-title">Usage Principal</label>
                            <div class="radio-options three-cols">
                                <label class="radio-card">
                                    <input type="radio" name="usage" value="bureautique" checked>
                                    <span class="radio-visual"><i class="fas fa-file-word"></i><span>Bureautique</span></span>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="usage" value="multimedia">
                                    <span class="radio-visual"><i class="fas fa-video"></i><span>Multimédia</span></span>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="usage" value="gaming">
                                    <span class="radio-visual"><i class="fas fa-gamepad"></i><span>Gaming</span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Précisions</label>
                            <textarea name="message" rows="4"></textarea>
                        </div>

                        <p id="msg-bloque" style="color:#E62020; font-size:0.9rem; margin-bottom:10px; display:none; text-align:center;">
                            * Veuillez accepter les conditions (popup) pour envoyer votre demande.
                        </p>
                        
                        <button type="submit" id="btn-send-form" class="btn btn-primary full-width" disabled>
                            Envoyer ma demande
                        </button>

                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container footer-grid">

            <div class="footer-col">
                <h4>Factor-I</h4>
                <p>L'informatique à vos côtés.</p>
                <p><i class="fas fa-map-marker-alt"></i> Adresse de l'entreprise ici</p>
                <p><i class="fas fa-phone"></i> 01 23 45 67 89</p>
            </div>

            <div class="footer-col">
                <h4>Liens Utiles</h4>
                <ul>
                    <li><a href="contact.html">Prendre rendez-vous</a></li>
                    <li><a href="maintenance.html">Maintenance Pro</a></li>
                    <li><a href="reparation.html">Réparation</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Informations Légales</h4>
                <ul>
                    <li><a href="mentions-legales.html">Mentions Légales</a></li>
                    <li><a href="cgv.html">CGV</a></li>
                    <li><a href="livraison.html">Livraison & Intervention</a></li>
                    <li><a href="bonus-reparation.html">Bonus Réparation</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 Factor-I. Tous droits réservés.</p>
        </div>
    </footer>

    <div id="cookie-popup" class="cookie-overlay">
        <div class="cookie-modal">
            <div class="modal-icon"><i class="fas fa-cookie-bite"></i></div>
            <h3>Avant de commencer</h3>
            <p>
                Pour configurer votre PC et nous envoyer votre demande, nous avons besoin de votre accord pour l'utilisation de cookies.
                <br><a href="mentions-legales.html" target="_blank">Politique de confidentialité</a>.
            </p>
            <button id="accept-cookies-btn" class="btn-modal">J'accepte et je continue</button>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/pc.js"></script>
</body>
</html>