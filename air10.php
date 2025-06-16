<?php

// Utilitaire
// Lit un fichier ligne par ligne et stocke chaque ligne dans un tableau
function readTheFile($fileName)
{
  $fileLines = [];

  // On ouvre le fichier en lecture seule
  $handle = fopen($fileName, "r");

  // Tant qu'on n'est pas à la fin du fichier, on lit une ligne à la fois
  while (!feof($handle)) {
    // fgets permet de lire une seule ligne, qu'on ajoute au tableau
    $fileLines[] = fgets($handle);
  }

  // On pense toujours à fermer le fichier
  fclose($handle);

  // On renvoie le tableau des lignes
  return $fileLines;
}

function showError()
{
  echo "error\n";
  exit;
}

// Error handling
function isValidCount($arguments)
{
  if (count($arguments) !== 1) {
    return false;
  }
  return true;
}

function isValidFile($fileName)
{
  if (!is_string($fileName)) {
    return false;
  }
  if (!file_exists($fileName)) {
    return false;
  }
  if (!is_readable($fileName)) {
    return false;
  }
  return true;
}

// Parsing
function parseArguments($argv)
{
  $arguments = array_slice($argv, 1);

  if (!isValidCount($arguments)) {
    showError();
  }

  $fileName = $arguments[0];

  if (!isValidFile($fileName)) {
    showError();
  }

  return $fileName;
}

// Résolution
function resolution($argv)
{
  $fileName = parseArguments($argv);
  $fileLines = readTheFile($fileName);
  displayFile($fileLines);
}

// Affichage
function displayFile($fileLines)
{
  foreach ($fileLines as $line) {
    echo ($line) . "\n";
  }
}

resolution($argv);
