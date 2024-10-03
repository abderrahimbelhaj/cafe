<?php
// Démarrer la session
session_start();
require_once 'config.php'; // Inclure votre fichier de connexion à la base de données

// Vérifier si l'utilisateur est connecté en tant que client
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'client') {
    echo "Accès refusé. Vous devez être connecté en tant que client pour réserver une table.";
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $numero_de_telephone = $_POST['numero_de_telephone'];
    $jour = $_POST['jour'];
    $heure = $_POST['heure']; // Ajouter l'heure
    $nombre_de_personnes = $_POST['nombre_de_personnes'];

    // Validation des champs
    if (empty($nom) || empty($numero_de_telephone) || empty($jour) || empty($heure) || empty($nombre_de_personnes)) {
        echo "Tous les champs sont obligatoires.";
    } else {
        // Insérer les informations dans la base de données
        $sql = "INSERT INTO reservations (nom, numero_de_telephone, jour, heure, nombre_de_personnes) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssi", $nom, $numero_de_telephone, $jour, $heure, $nombre_de_personnes);
            if ($stmt->execute()) {
                echo "Réservation effectuée avec succès.";
            } else {
                echo "Erreur lors de la réservation : " . $conn->error;
            }
            $stmt->close();
        }
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!-- Formulaire HTML pour la réservation -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver une Table</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <!-- Linking Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
   

    <!-- Bouton de déconnexion -->
   







     <!-- Contact section -->
     <section class="contact-section" id="contact">
     <form method="post" action="logout.php" style=" position: absolute;
    top: 15px;
    right: 15px;" >
        <button type="submit" >Logout</button>
    </form>
     
        <h2 class="section-title"> Reserve a table</h2>
        <div class="section-content">
     

           <form method="post" action="" class="contact-form">
           
        <input type="text" id="nom" name="nom"  class="form-input" placeholder="name" required><br>

            <input type="text" id="numero_de_telephone" name="numero_de_telephone" placeholder="Numéro de téléphone" class="form-input" required />
           
            <input type="date" id="jour" name="jour" required><br><br>
            <input type="text" id="heure" name="heure"  placeholder="Heure(DM:XY)" class="form-input" required />
            <input type="number"  id="nombre_de_personnes" name="nombre_de_personnes"  placeholder="nombre de personnes" class="form-input" required />
            <button type="submit" class="button submit-button">Submit</button>
          </form>
        </div>
      </section>

</body>
</html>
