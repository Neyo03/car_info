#!/usr/bin/php
<?php

require_once __DIR__ . '/src/autoload.php';

use App\Core\Database\MigrationRunner;

echo "=== CLI Database Manager ===\n";
echo "1. Générer & Mettre à jour \n";
echo "2. Quitter\n";

echo "Choisissez une option : ";
$handle = fopen("php://stdin", "r");
$choice = trim(fgets($handle));
fclose($handle);

switch ($choice) {
    case "1":
        echo "Création & Mise à jour des tables et colonnes...\n";
        (new MigrationRunner())->migrate();
        break;

    case "2":
        echo "Fermeture du programme.\n";
        exit;

    default:
        echo "Option invalide !\n";
}

echo "Opération terminée.\n";
