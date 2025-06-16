<?php
// Utils

// Applique l'opérateur donné à chaque élément d'une liste de nombres
function calculateListWithOperator($numbers, $operatorSign, $operatorValue)
{
  $operations = getOperatorFunctionMap();
  $found = false;

  // Vérifie manuellement si le signe est présent dans la map
  foreach ($operations as $key => $function) {
    if ($key === $operatorSign) {
      $found = true;
      break;
    }
  }

  if ($found === false) {
    showError();
  }

  for ($i = 0; $i < count($numbers); $i++) {
    $number = $numbers[$i];
    $numbers[$i] = $operations[$operatorSign]($number, $operatorValue);
  }

  return $numbers;
}

// Retourne la map des signes opérateurs et leur fonction associée
function getOperatorFunctionMap()
{
  return [
    '+' => function ($a, $b) {
      return $a + $b;
    },
    '-' => function ($a, $b) {
      return $a - $b;
    },
    '*' => function ($a, $b) {
      return $a * $b;
    },
    '/' => function ($a, $b) {
      return $a / $b;
    },
  ];
}

// Sépare un opérant (ex: "+5") en signe et valeur numérique
function extractOperatorParts($operator)
{
  $sign = $operator[0];
  $value = '';

  for ($i = 1; $i < strlen($operator); $i++) {
    $value .= $operator[$i];
  }

  return [$sign, $value];
}

function showError()
{
  echo "error\n";
  exit;
}
// Error Handling


function isValidNumberList($numbers)
{
  if (count($numbers) < 2) {
    return false;
  }
  foreach ($numbers as $number) {
    if (trim($number) === '') {
      return false;
    }
    if (!is_numeric($number)) {
      return false;
    }
  }
  return true;
}

function isValidOperator($operator)
{
  if (strlen($operator) < 2) {
    return false;
  }
  if (ctype_alnum($operator)) {
    return false;
  }
  return true;
}

// Parsing

function parseArguments($argv)
{
  return array_slice($argv, 1);
}

// Résolution

function resolution($argv)
{
  $arguments = parseArguments($argv);
  $operator = array_pop($arguments);
  $numberList = $arguments;

  if (!isValidNumberList($numberList)) {
    showError();
  }

  if (!isValidOperator($operator)) {
    showError();
  }

  [$sign, $value] = extractOperatorParts($operator);
  $finalList = calculateListWithOperator($numberList, $sign, $value);
  displayResult($finalList);
}

// Affichage

// Affiche la liste finale sur une seule ligne séparée par des espaces
function displayResult($numberList)
{
  $line = '';
  for ($i = 0; $i < count($numberList); $i++) {
    $line .= $numberList[$i];
    if ($i < count($numberList) - 1) {
      $line .= ' ';
    }
  }
  echo $line . "\n";
}

resolution($argv);
