<?php

require_once __DIR__ . '/../src/Entity/User.php';

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
</head>
<body>
<h1>Voiture</h1>
<ul>
        <li><?= htmlspecialchars($car->getNom()) ?></li>
</ul>
</body>
</html>
