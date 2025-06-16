<?php

// Utilitaire
function sortedFusion($firstList, $secondList)
{
  $finalList = [];
  $i = 0;
  $j = 0;

  while (true) {
    if ($i >= count($firstList)) {
      break; // on a fini la première liste
    }

    if ($j >= count($secondList)) {
      break; // on a fini la deuxième liste
    }
    // Si l'élément de la première liste est plus petit ou égal
    if ($firstList[$i] <= $secondList[$j]) {
      $finalList[] = $firstList[$i];
      $i++;
      continue;
    }

    // Sinon, on prend l'élément de la deuxième liste
    $finalList[] = $secondList[$j];
    $j++;
  }

  // Ajout du reste de la deuxième liste si la première est finie
  while ($j < count($secondList)) {
    $finalList[] = $secondList[$j];
    $j++;
  }

  // Ajout du reste de la première liste si la deuxième est finie
  while ($i < count($firstList)) {
    $finalList[] = $firstList[$i];
    $i++;
  }

  return $finalList;
}

function showError()
{
  echo "error\n";
  exit;
}
// Error Handling
function isValidNumbers($numbers)
{
  if (count($numbers) < 1) {
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
// parsing
function parseArguments($argv)
{
  $arguments = array_slice($argv, 1);
  $fusionIndex = null;
  $isHere = false;
  for ($i = 0; $i < count($arguments); $i++) {
    if ($arguments[$i] === "fusion") {
      $fusionIndex = $i;
      $isHere = true;
    }
  }
  if ($isHere == false) {
    showError();
  }

  $firstList = array_slice($arguments, 0, $fusionIndex);
  $secondList = array_slice($arguments, $fusionIndex + 1);

  return [$firstList, $secondList];
}

// Resolution
function resolution($argv)
{
  [$firstList, $secondList] = parseArguments($argv);
  if (!isValidNumbers($firstList)) {
    showError();
  }
  if (!isValidNumbers($secondList)) {
    showError();
  }
  $finalList = sortedFusion($firstList, $secondList);
  displayList($finalList);
}

// Affichage
function displayList($finalList)
{
  foreach ($finalList as $number) {
    echo ($number) . "\n";
  }
}

resolution($argv);
