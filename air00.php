<?php

// Utilitaire


function splitStringManual($string)
{
  $currentWord = '';
  $result = [];
  for ($i = 0; $i < strlen($string); $i++) {
    $char = $string[$i];
    if (isSeparator($char)) {
      $result[] = $currentWord;
      $currentWord = '';
      continue;
    }
    $currentWord .= $char;
  }
  if ($currentWord !== '') {
    $result[] = $currentWord;
  }
  return $result;
}


function isSeparator($char)
{
  $separators = [' ', "\t", "\n", ","];
  foreach ($separators as $separator) {
    if ($char == $separator) {
      return true;
    }
  }
  return false;
}

function showError()
{
  echo "error" . "\n";
  exit;
}


// Error Handling 

function isValidString($argument)
{
  if (count($argument) !== 1) {
    return false;
  }
  foreach ($argument as $arg) {
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
  $argument = array_slice($argv, 1);

  if (!isValidString($argument)) {
    showError();
  }


  return $argument[0];
}



// Resolution
function resolution($argv)
{
  $string = parseArguments($argv);
  $result = splitStringManual($string);
  displayStrings($result);
}


// Affichage

function displayStrings($result)
{

  foreach ($result as $arg) {
    echo ($arg) . "\n";
  }
}

resolution($argv);
