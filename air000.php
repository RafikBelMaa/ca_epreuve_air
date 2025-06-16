<?php

//  Utils

function splitStringManual($string, $separators)
{
  $currentWord = '';
  $result = [];

  for ($i = 0; $i < strlen($string); $i++) {
    $char = $string[$i];

    if (isWordSeparator($char, $separators)) {
      if ($currentWord !== '') {
        $result[] = $currentWord;
        $currentWord = '';
      }
      continue;
    }

    $currentWord .= $char;
  }

  if ($currentWord !== '') {
    $result[] = $currentWord;
  }

  return $result;
}

function isWordSeparator($char, $separators)
{
  for ($i = 0; $i < count($separators); $i++) {
    if ($separators[$i] === $char) {
      return true;
    }
  }
  return false;
}

function generateSeparators($string)
{
  $separators = [];

  for ($i = 0; $i < strlen($string); $i++) {
    $char = $string[$i];

    if (!ctype_alpha($char)) {
      $alreadyExists = false;

      for ($j = 0; $j < count($separators); $j++) {
        if ($separators[$j] === $char) {
          $alreadyExists = true;
          break;
        }
      }

      if (!$alreadyExists) {
        $separators[] = $char;
      }
    }
  }

  return $separators;
}

function showError()
{
  echo "error\n";
  exit;
}

//  Error Handling

function isValidInput($args)
{
  if (count($args) !== 1) {
    return false;
  }

  if (trim($args[0]) === '') {
    return false;
  }

  if (is_numeric($args[0])) {
    return false;
  }

  return true;
}

//  Parsing

function parseArgument($argv)
{
  $args = array_slice($argv, 1);

  if (!isValidInput($args)) {
    showError();
  }

  return $args[0];
}

//  Résolution

function resolveSplit($argv)
{
  $inputString = parseArgument($argv);
  $separatorArray = generateSeparators($inputString);
  $words = splitStringManual($inputString, $separatorArray);
  displayWords($words);
}

//  Affichage

function displayWords($words)
{
  foreach ($words as $word) {
    echo $word . "\n";
  }
}

// 🚀 Exécution

resolveSplit($argv);
