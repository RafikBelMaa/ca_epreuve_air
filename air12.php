<?php
// Utilitaire

// Fonction récursive qui trie un tableau de nombres avec l'algorithme QuickSort
function my_quick_sort($numbers)
{
  // Cas de base : si un seul élément ou aucun, le tableau est déjà trié
  if (count($numbers) <= 1) {
    return $numbers;
  }

  // On prépare deux sous-tableaux : un pour les valeurs inférieures au pivot, un pour les supérieures
  $lowerThanPivot = [];
  $higherThanPivot = [];

  // On choisit le pivot au centre du tableau (ici, floor pour éviter les warnings de conversion)
  $firstPivotIndex = floor(count($numbers) / 2);
  $firstPivot = $numbers[$firstPivotIndex];

  // On parcourt tout le tableau sauf le pivot
  for ($i = 0; $i < count($numbers); $i++) {
    if ($i === $firstPivotIndex) {
      continue; // on saute l'élément qui est déjà notre pivot
    }

    if ($numbers[$i] < $firstPivot) {
      $lowerThanPivot[] = $numbers[$i]; // tri à gauche
    }

    if ($numbers[$i] > $firstPivot) {
      $higherThanPivot[] = $numbers[$i]; // tri à droite
    }
  }

  // On applique récursivement le tri aux deux sous-tableaux
  $finalLower = my_quick_sort($lowerThanPivot);
  $finalHigher = my_quick_sort($higherThanPivot);

  // On reconstruit manuellement le tableau trié complet
  $triedNumbers = [];

  foreach ($finalLower as $number) {
    $triedNumbers[] = $number;
  }

  $triedNumbers[] = $firstPivot;

  foreach ($finalHigher as $number) {
    $triedNumbers[] = $number;
  }

  return ($triedNumbers);
}


function showError()
{
  echo "error\n";
  exit;
}

// Error handling
function isValidNumbers($arguments)
{
  if (count($arguments) < 3) {
    return false;
  }
  foreach ($arguments as $argument) {
    if (!ctype_digit($argument)) {
      return false;
    }
    if (trim($argument) === '') {
      return false;
    }
  }

  return true;
}


// Parsing
function parseArguments($argv)
{
  $arguments = array_slice($argv, 1);
  if (!isValidNumbers($arguments)) {
    showError();
  }
  return $arguments;
}

// Resolution 
function resolution($argv)
{
  $numbers = parseArguments($argv);
  $triedNumbers = my_quick_sort($numbers);
  displayNumbers($triedNumbers);
}

// Affichage
function displayNumbers($triedNumbers)
{
  $line = '';

  for ($i = 0; $i < count($triedNumbers); $i++) {
    $line .= $triedNumbers[$i];

    // Ajouter un espace sauf après le dernier
    if ($i < count($triedNumbers) - 1) {
      $line .= ' ';
    }
  }

  echo $line . "\n";
}

resolution($argv);
