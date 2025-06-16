<?php
// Utilitaire
function myRotation($arguments)
{
  $rotatedArray = [];
  for ($i = 1; $i < count($arguments); $i++) {
    $rotatedArray[] = $arguments[$i];
  }
  $rotatedArray[] = $arguments[0];
  return $rotatedArray;
}
function showError()
{
  echo "error\n";
  exit;
}
// Error Handling
function isValidArguments($arguments)
{
  if (count($arguments) < 2) {
    return false;
  }
  foreach ($arguments as $argument) {
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
  if (!isValidArguments($arguments)) {
    showError();
  }
  return $arguments;
}

// Resolution
function resolution($argv)
{
  $arguments = parseArguments($argv);
  $counterRotation = 0;
  for ($i = 0; $i < count($arguments); $i++) {
    $arguments = myRotation($arguments);
    $counterRotation++;
    displayNewArray($arguments, $counterRotation);
  }
}

// Affichage
function displayNewArray($arguments, $counterRotation)
{ {
    $line = "Rotation Numéro :  " . $counterRotation . " ";

    for ($i = 0; $i < count($arguments); $i++) {
      $line .= $arguments[$i];

      // Ajoute une virgule sauf sur le dernier élément
      if ($i < count($arguments) - 1) {
        $line .= ", ";
      }
    }

    echo $line . "\n";
  }
}


resolution($argv);
