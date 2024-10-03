<?php
session_start();
require_once 'config.php'; // Assurez-vous que ce fichier configure correctement la connexion à la base de données

// Vérifier si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "Access denied. You must be an admin to view this page.";
    exit();
}

// Requête pour récupérer toutes les réservations
$sql = "SELECT id, nom, numero_de_telephone, jour, heure, nombre_de_personnes FROM reservations";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations List</title>
    <link rel="stylesheet" href="manage_products.css"> <!-- Assurez-vous que le chemin est correct -->
</head>
<body>
<header>
      
       

       

        
            <a href="manage_products.php" class="nav-link"> Home</a>
        
          
          
       
    </header>
    <div class="reservation-container">
        <h2>List of Reservations</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Day</th>
                <th>Time</th>
                <th>Number of People</th>
            </tr>
            <?php
            // Vérifier si des réservations existent
            if ($result->num_rows > 0) {
                // Afficher chaque réservation dans une ligne de tableau
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['numero_de_telephone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jour']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['heure']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre_de_personnes']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No reservations found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>






















