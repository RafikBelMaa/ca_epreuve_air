<?php
// Utilitaire

// Retourne la première valeur qui n’a pas de paire dans le tableau

function getUniqValue($arguments)
{
  for ($i = 0; $i < count($arguments); $i++) {
    $match = false;

    // Compare à tous les autres éléments sauf lui-même
    for ($j = 0; $j < count($arguments); $j++) {
      if ($j === $i) {
        continue; // on saute l'auto-comparaison
      }

      if ($arguments[$j] === $arguments[$i]) {
        $match = true;
      }
    }

    // Si aucune paire trouvée, on retourne la valeur unique
    if ($match === false) {
      return $arguments[$i];
    }
  }

  // Si aucune valeur sans paire n’a été trouvée
  showError();
}


function showError()
{
  echo "error" . "\n";
  exit;
}
// Error Handling 
function isValidArgument($arguments)
{
  if (count($arguments) < 3) {
    return false;
  }
  foreach ($arguments as $arg) {
    # code...

    if (trim($arg) === '') {
      return false;
    }

    /*  if (!ctype_alnum($arg)) {
      return false;
    } */
  }
  return true;
}
// Parsing
function parseArguments($argv)
{
  $arguments = array_slice($argv, 1);
  if (!isValidArgument($arguments)) {
    showError();
  }
  return $arguments;
}
// Resolution
function resolution($argv)
{
  $arguments = parseArguments($argv);
  $uniqValue = getUniqValue($arguments);
  displayUniqValue($uniqValue);
}
// Affichage*
function displayUniqValue($uniqValue)
{
  echo ($uniqValue) . "\n";
}


resolution($argv);
