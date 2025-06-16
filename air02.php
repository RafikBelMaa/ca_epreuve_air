<?php
// Utilitaire
function fusionBySeparator($strings, $separator)
{
  $finalString = '';
  for ($i = 0; $i < count($strings); $i++) {
    $finalString .= $strings[$i];
    if ($i < count($strings) - 1) {
      $finalString .= $separator;
      # code...
    }
  }
  return $finalString;
}
function showError()
{
  echo "error" . "\n";
  exit;
}
// Error Handling 

function isValidString($strings)
{
  if (count($strings) < 2) {
    return false;
  }
  foreach ($strings as $string) {
    # code...

    if (trim($string) === '') {
      return false;
    }

    if (!is_string($string)) {
      return false;
    }
  }

  return true;
}
function isValidSeparator($separator)
{
  if (strlen($separator) !== 1) {
    return false;
    # code...
  }
  if (ctype_alnum($separator)) {
    # code...
    return false;
  }
  return true;
}

// Parsing
function parseArguments($argv)
{
  $arguments = array_slice($argv, 1);

  return $arguments;
}
// Resolution
function resolution($argv)
{
  $arguments = parseArguments($argv);
  $separator = array_pop($arguments);
  $strings = $arguments;
  if (!isValidString($strings)) {
    showError();
  }
  if (!isValidSeparator($separator)) {
    showError();
  }
  $finalString = fusionBySeparator($strings, $separator);
  displayString($finalString);
}

// Affichage
function displayString($finalString)
{
  echo ($finalString) . "\n";
}


resolution($argv);
