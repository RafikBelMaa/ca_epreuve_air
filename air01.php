<?php
// Utilitaire

// Découpe une chaîne manuellement à chaque fois que le séparateur est trouvé.
// Construit chaque sous-chaîne sans utiliser substr(), puis retourne le tableau final.
function splitBySeparator($string, $separator)
{
  $result = [];
  $indexCounter = 0;
  $limit = strlen($string) - strlen($separator);

  for ($i = 0; $i <= $limit; $i++) {
    $match = true;

    // Vérifie si le séparateur commence à la position $i
    for ($j = 0; $j < strlen($separator); $j++) {
      if ($string[$i + $j] !== $separator[$j]) {
        $match = false;
        break;
      }
    }

    // Si le séparateur est trouvé, on découpe la chaîne depuis $indexCounter jusqu’à $i
    if ($match) {
      $temporaryString = '';
      for ($k = $indexCounter; $k < $i; $k++) {
        $temporaryString .= $string[$k];
      }

      $result[] = $temporaryString;

      // On met à jour la prochaine position de départ
      $indexCounter = $i + strlen($separator);
      $i = $indexCounter - 1; // On repositionne l’index pour éviter de repasser sur le séparateur
    }
  }

  // Ajoute le dernier morceau (s’il en reste un) après la dernière occurrence
  if ($indexCounter < strlen($string)) {
    $temporaryString = '';
    for ($k = $indexCounter; $k < strlen($string); $k++) {
      $temporaryString .= $string[$k];
    }
    $result[] = $temporaryString;
  }

  return $result;
}



function showError()
{
  echo "error" . "\n";
  exit;
}



// Error Handling 

function isValidArguments($arguments)
{
  if (count($arguments) !== 2) {
    return false;
  }
  foreach ($arguments as $arg) {
    # code...

    if (trim($arg) === '') {
      return false;
    }

    if (is_numeric($arg)) {
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
function resolveSplitByString($argv)
{
  $arguments =  parseArguments($argv);
  $string = $arguments[0];
  $separator = $arguments[1];
  $result = splitBySeparator($string, $separator);
  displayString($result);
}

// Affichage
function displayString($result)
{

  foreach ($result as $arg) {
    echo ($arg) . "\n";
  }
}



resolveSplitByString($argv);
