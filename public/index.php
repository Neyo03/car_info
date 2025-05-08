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
<table>
    <thead>
    <tr>
        <th colspan="2">Informations voiture</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Nom</td>
        <td><?= $car->nom ?></td>
    </tr>

    </tbody>
</table>
</body>
</html>
