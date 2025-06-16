<?php
// Utilitaire
function getFinalStrings($strings, $string)
{
  $finalStrings = [];
  for ($i = 0; $i < count($strings); $i++) {
    $match = false;
    for ($j = 0; $j < strlen($strings[$i]); $j++) {
      if (strtolower($strings[$i][$j]) == strtolower($string)) {
        $match = true;
        break;
        # code...
      }
    }
    if ($match == false) {
      $finalStrings[] = $strings[$i];
      # code...
    }
  }
  return $finalStrings;
}
function showError()
{
  echo "error\n";
  exit;
}
// Error handling
function isValidStrings($strings)
{
  if (count($strings) < 2) {
    return false;
  }
  foreach ($strings as $string) {
    if (trim($string) === '') {
      return false;
    }
    if (!is_string($string)) {
      return false;
    }
  }
  return true;
}

function isValidString($string)
{
  if (strlen($string) !== 1) {
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
  $string = array_pop($arguments);
  $strings = $arguments;
  if (!isValidString($string)) {
    showError();
    # code...
  }
  if (!isValidStrings($strings)) {
    showError();
    # code...
  }
  $finalStrings = getFinalStrings($strings, $string);
  displayFinalString($finalStrings);
}

// Affichage
function displayFinalString($finalStrings)
{
  foreach ($finalStrings as $string) {
    echo ($string) . ",";
  }
}

resolution($argv);
