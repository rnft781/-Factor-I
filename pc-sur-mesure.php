<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// --- 0. IMPORTATION DE PHPMAILER ---
// Assure-toi que le chemin est bon par rapport à ton fichier php
use PHPMailer\PHPmailer\PHPMailer;
use PHPMailer\PHPmailer\Exception;
use PHPMailer\PHPmailer\SMTP;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

// --- 1. CONFIGURATION BDD ---
//$host = 'localhost'; $user = 'admin'; $pass = 'admin123'; $db = 'formulaire_contact';
//$conn = new mysqli($host, $user, $pass, $db);
//if ($conn->connect_error) { die("Erreur critique : " . $conn->connect_error); }

$status_message = "";

// --- 2. TRAITEMENT ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Nettoyage
    $nom     = htmlspecialchars($_POST['nom']);
    $prenom  = htmlspecialchars($_POST['prenom']);
    $email   = htmlspecialchars($_POST['email']);
    $tel     = htmlspecialchars($_POST['tel']);
    $type    = htmlspecialchars($_POST['machine_type']);
    $usage   = htmlspecialchars($_POST['usage']);
    $details = htmlspecialchars($_POST['message']);

    // Insertion SQL
   // $sql = "INSERT INTO projets_pc (nom, prenom, email, telephone, type_machine, usage_principal, details) 
           // VALUES ('$nom', '$prenom', '$email', '$tel', '$type', '$usage', '$details')";

    //if ($conn->query($sql) === TRUE) {
        
        // === 3. ENVOI MAIL VIA SMTP (PHPMailer) ===
        $mail = new PHPMailer(true);

        try {
            // A. Configuration du Serveur SMTP (C'est ici qu'il faut tes infos !)
            $mail->SMTPDebug =0; // Décommente cette ligne si le mail ne part pas (pour voir l'erreur)
            
            $mail->isSMTP();
            
            // EXEMPLE POUR GMAIL (Si tu utilises Gmail)
            $mail->Host       = 'smtp.gmail.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'testfactorienvoie@gmail.com'; // Ton adresse Gmail
            $mail->Password   = 'urey jzju ffiz pqcu '; // Voir note en bas*
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // EXEMPLE POUR OVH / IONOS (Si tu as un mail pro)
            /*
            $mail->Host       = 'ssl0.ovh.net'; 
            $mail->Username   = 'contact@factor-i.fr';
            $mail->Password   = 'ton-mot-de-passe-mail';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            */

            // B. Expéditeur et Destinataire
            $mail->setFrom('testfactorienvoie@gmail.com', 'Site Factor-I'); // Qui envoie (ta propre adresse)
            $mail->addAddress('testfactorienvoie@gmail.com');     // Qui reçoit (toi aussi)
            $mail->addReplyTo($email, "$prenom $nom");        // Pour répondre au client en 1 clic

            // C. Contenu
            $mail->isHTML(false); // Format texte simple
            $mail->Subject = "Nouveau Projet PC : " . stripslashes($prenom) . " " . stripslashes($nom);
            
            $corpsMessage = "Bonjour,\n\nUne nouvelle demande est arrivée !\n\n";
            $corpsMessage .= "Nom : " . stripslashes($nom) . " " . stripslashes($prenom) . "\n";
            $corpsMessage .= "Email : " . stripslashes($email) . "\n";
            $corpsMessage .= "Tel : " . stripslashes($tel) . "\n";
            $corpsMessage .= "Type : " . ucfirst($type) . " | Usage : " . ucfirst($usage) . "\n\n";
            $corpsMessage .= "Details :\n" . stripslashes($details);
            
            $mail->Body = $corpsMessage;

            $mail->send(); // Envoi !

            header("Location: pc-sur-mesure.php?success=1#formulaire-projet");
            exit();

        } catch (Exception $e) {
            // Si le mail plante, on ne bloque pas le site, mais on peut loguer l'erreur
            // echo "Erreur Mail: {$mail->ErrorInfo}";
                    $status_message = "<div style='background:#f8d7da; color:#721c24; padding:15px; border-radius:5px; margin-bottom:20px; text-align:center;'>❌ Erreur Mail : " . $mail->ErrorInfo . "</div>";

        }   
}     

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $status_message = "<div style='background:#d4edda; color:#155724; padding:15px; border-radius:5px; margin-bottom:20px; text-align:center;'>✅ <strong>Demande reçue !</strong> Nous allons étudier votre projet.</div>";
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