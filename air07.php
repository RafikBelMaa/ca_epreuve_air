<?php

// Utilitaire

// Insère une nouvelle valeur dans un tableau trié tout en maintenant l'ordre croissant
function insertIntoNumbers($numbers, $number)
{
  $inserted = false;       // Permet de savoir si la valeur a déjà été insérée
  $newNumbers = [];        // Nouveau tableau qui contiendra le résultat trié

  for ($i = 0; $i < count($numbers); $i++) {
    // Si la valeur n'est pas encore insérée ET qu'elle est inférieure à l'élément courant :
    // → c'est le bon moment pour l'insérer
    if (!$inserted) {
      if ($number < $numbers[$i]) {
        $newNumbers[] = $number;
        $inserted = true; // On marque qu'on l'a insérée pour ne plus jamais le refaire
      }
    }

    // On ajoute l'élément courant du tableau d'origine dans tous les cas
    $newNumbers[] = $numbers[$i];
  }

  // Si la valeur n'a toujours pas été insérée (ex: si elle est plus grande que tous les autres)
  // → on l'ajoute en fin de tableau
  if (!$inserted) {
    $newNumbers[] = $number;
  }

  return $newNumbers; // On retourne le tableau final, trié
}

function showError()
{
  echo "error\n";
  exit;
}
// Error Handling
function isValidNumbers($numbers)
{
  if (count($numbers) < 1) {
    return false;
  }
  foreach ($numbers as $number) {
    if (trim($number) === '') {
      return false;
    }
    if (!is_numeric($number)) {
      return false;
    }
  }
  return true;
}

function isValidNumber($number)
{


  if (trim($number) === '') {
    return false;
  }
  if (!is_numeric($number)) {
    return false;
  }
  return true;
}
// Parsing
function parseArguments($argv)
{
  return array_slice($argv, 1);
}

// Resolution
function resolution($argv)
{
  $arguments = parseArguments($argv);
  $number = array_pop($arguments);
  $numbers = $arguments;
  if (!isValidNumbers($numbers)) {
    showError();
  }
  if (!isValidNumber($number)) {
    showError();
  }
  $newNumbers = insertIntoNumbers($numbers, $number);
  displayNewNumbers($newNumbers);
}

// Affichage

function displayNewNumbers($newNumbers)
{
  foreach ($newNumbers as $number) {
    echo ($number) . "\n";
  }
}



resolution($argv);
