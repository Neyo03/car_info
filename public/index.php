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
        <td>It is a long established fact that a reader will be distracted by the readable content of a page when
            looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
            letters, as opposed to using 'Content here, content here', making it look like readable English. Many
            desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a
            search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved
            over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
        </td>
    </tr>
    <tr>
        <td>Nom</td>
        <td><?= $car->nom ?></td>
    </tr>
    </tbody>
</table>
</body>
</html>
