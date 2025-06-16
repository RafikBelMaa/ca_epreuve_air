<?php

// Utilitaire

// Construit un tableau de lignes représentant une pyramide centrée.
// Chaque ligne est une chaîne contenant des espaces + caractères.
// Aucun affichage ici, juste la construction logique.
function buildPyramidLines($char, $nombreEtages)
{
  $lines = [];

  for ($i = 1; $i <= $nombreEtages; $i++) {
    $line = "";

    // Ajoute les espaces à gauche
    for ($j = 0; $j < $nombreEtages - $i; $j++) {
      $line .= " ";
    }

    // Ajoute les caractères (quantité impaire)
    for ($j = 0; $j < 2 * $i - 1; $j++) {
      $line .= $char;
    }

    $lines[] = $line;
  }

  return $lines;
}

function showError()
{
  echo "error\n";
  exit;
}

// Error Handling

function isValidArguments($arguments)
{
  if (count($arguments) !== 2) {
    return false;
  }
  return true;
}

function isValidNumber($numberEtage)
{
  if (!ctype_digit($numberEtage)) {
    return false;
  }
  if (trim($numberEtage) === '') {
    return false;
  }
  return true;
}

function isValidChar($char)
{
  if (!ctype_alpha($char)) {
    return false;
  }
  if (trim($char) === '') {
    return false;
  }
  return true;
}

// Parsing

function parseArguments($argv)
{
  $arguments = array_slice($argv, 1);
  if (!isValidArguments($arguments)) {
    showError();
  }

  return $arguments;
}

// Résolution

function resolution($argv)
{
  $arguments = parseArguments($argv);
  $numberEtage = $arguments[1];
  if (!isValidNumber($numberEtage)) {
    showError();
  }
  $char = $arguments[0];
  if (!isValidChar($char)) {
    showError();
  }

  $lines = buildPyramidLines($char, $numberEtage);
  displayPyramid($lines);
}

// Affichage

function displayPyramid($lines)
{
  foreach ($lines as $line) {
    echo $line . "\n";
  }
}

resolution($argv);
