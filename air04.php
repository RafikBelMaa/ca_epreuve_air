<?php
// Utilitaire

// Supprime les caractères identiques consécutifs d'une chaîne
function getFinalString($argument)
{
  $precedentChar = '';             // Stocke le caractère précédent (initialement vide)
  $temporaryString = '';       // Construit la chaîne sans doublons adjacents

  for ($i = 0; $i < strlen($argument); $i++) {
    // Ajoute le caractère seulement s'il est différent du précédent
    if ($argument[$i] !== $precedentChar) {
      $precedentChar = $argument[$i];
      $temporaryString .= $argument[$i];
    }
  }

  return $temporaryString;
}

function showError()
{
  echo "error" . "\n";
  exit;
}

// Error Handling 
function isValidCount($arguments)
{
  if (count($arguments) !== 1) {
    return false;
  }
  return true;
}
function isValidArgument($argument)
{
  if (trim($argument) === '') {
    return false;
  }
  return true;
}

// Parsing
function parseArgument($argv)
{
  $arguments = array_slice($argv, 1);
  if (!isValidCount($arguments)) {
    showError();
  }
  $argument = $arguments[0];
  if (!isValidArgument($argument)) {
    showError();
  }
  return $argument;
}

// Resolution
function resolution($argv)
{
  $argument = parseArgument($argv);
  $finalString = getFinalString($argument);
  displayFinalString($finalString);
}
// Affichage*
function displayFinalString($finalString)
{
  echo ($finalString) . "\n";
}


resolution($argv);
