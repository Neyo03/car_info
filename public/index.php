<?php

require_once __DIR__ . '/../src/autoload.php';

use App\Entity\Car;

$car = Car::getOneById(1);
if (!$car) {
    exit('Pas de voiture trouvée');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Informations de ma voiture</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
    <div class="car-details">
        <ul class="car-info">
            <li><strong>Nom:</strong> <br> <span><?= $car->getNom() ?></span></li>
        </ul>
    </div>
</body>
</html>
