<?php

// ==========================
// Bloc Utilitaire
// ==========================

// Lance les tests pour tous les exercices PHP présents dans le dossier courant
function runTestsForAllExercises()
{
  // Récupère la liste des fichiers d'exercices PHP
  $exerciseFiles = getExerciseFileNames();
  $totalSuccess = 0; // compteur succès global
  $totalTests = 0;   // compteur total global

  // Parcourt tous les fichiers d'exercices
  for ($i = 0; $i < count($exerciseFiles); $i++) {
    $fileName = $exerciseFiles[$i];
    // Lance tous les tests pour un exercice donné
    list($successCount, $testCount) = runTestsForSingleExercise($fileName);

    // Cumule les résultats
    $totalSuccess += $successCount;
    $totalTests += $testCount;
  }

  // Affiche le résumé final des tests
  displayFinalSummary($totalSuccess, $totalTests);
}

// Lance tous les tests pour un exercice donné
function runTestsForSingleExercise($exerciseFileName)
{
  // Charge les cas de tests depuis le fichier JSON
  $testCases = loadTestCasesFromJson($exerciseFileName);
  $successCount = 0;         // compteur succès pour cet exercice
  $totalCount = count($testCases); // total des tests pour cet exercice

  // Pour chaque cas de test
  for ($i = 0; $i < $totalCount; $i++) {
    $args = $testCases[$i];
    // Exécute le script avec les arguments
    $output = executeExerciseScript($exerciseFileName, $args);
    // Vérifie si le test a échoué (sortie contenant 'error')
    $isFailure = isTestFailure($output);

    $testIndex = $i + 1;
    // Prépare le label pour affichage
    $label = getBaseFileName($exerciseFileName) . " ($testIndex/$totalCount) : ";

    // Affiche success en vert ou failure en rouge
    if (!$isFailure) {
      echo $label . "\033[32msuccess\033[0m\n";
      $successCount++;
    } else {
      echo $label . "\033[31mfailure\033[0m\n";
      // Affiche la sortie brute pour debug
      echo ">> Output: $output\n";
    }
  }

  // Retourne le nombre de succès et total des tests pour cet exercice
  return array($successCount, $totalCount);
}

// Affiche le résumé final des résultats
function displayFinalSummary($successCount, $totalCount)
{
  echo "\nTotal success: \033[32m($successCount/$totalCount)\033[0m\n";
}

// Retourne true si la sortie contient la chaîne 'error'
function isTestFailure($output)
{
  return containsSubstring($output, 'error');
}

// Exécute un script PHP avec arguments, retourne la sortie nettoyée
function executeExerciseScript($fileName, $args)
{
  $command = "php " . $fileName;

  // Ajoute les arguments tels quels, sans échappement
  for ($i = 0; $i < count($args); $i++) {
    $command .= " " . $args[$i];
  }

  // Exécute la commande et récupère la sortie
  $output = shell_exec($command);

  // Supprime espaces et retours à la ligne superflus
  return trim($output);
}

// Charge les cas de tests depuis le fichier JSON associé à un exercice
function loadTestCasesFromJson($exerciseFileName)
{
  $testCases = array();
  $baseName = getBaseFileName($exerciseFileName);
  $jsonPath = 'tests/' . $baseName . '.json';

  // Si le fichier JSON n'existe pas, on retourne un tableau vide
  if (!file_exists($jsonPath)) {
    return $testCases;
  }

  // Lit le contenu du fichier
  $content = file_get_contents($jsonPath);
  // Sépare le contenu en lignes
  $lines = explode("\n", $content);

  // Parcourt chaque ligne pour extraire les arguments
  for ($i = 0; $i < count($lines); $i++) {
    $line = $lines[$i];

    // Cherche la ligne contenant "args"
    if (containsSubstring($line, '"args"')) {
      // Extrait le tableau d'arguments de la ligne
      $args = extractArgumentsArray($line);
      // Ajoute les arguments au tableau des cas de test
      $testCases[] = $args;
    }
  }

  return $testCases;
}

// Extrait un tableau d'arguments d'une ligne JSON contenant "args"
function extractArgumentsArray($line)
{
  $isInsideBrackets = false;
  $substring = '';

  // Cherche la partie entre crochets [...]
  for ($i = 0; $i < strlen($line); $i++) {
    $char = $line[$i];
    if ($char === '[') {
      $isInsideBrackets = true;
      continue;
    }
    if ($char === ']') {
      $isInsideBrackets = false;
      break;
    }
    if ($isInsideBrackets) {
      $substring .= $char;
    }
  }

  // Supprime les guillemets doubles "
  $clean = '';
  for ($i = 0; $i < strlen($substring); $i++) {
    if ($substring[$i] !== '"') {
      $clean .= $substring[$i];
    }
  }

  // Sépare la chaîne par des virgules en arguments individuels
  $args = array();
  $current = '';
  for ($i = 0; $i < strlen($clean); $i++) {
    if ($clean[$i] === ',') {
      $args[] = trim($current);
      $current = '';
    } else {
      $current .= $clean[$i];
    }
  }
  $args[] = trim($current); // ajoute le dernier argument

  return $args;
}

// Lit un fichier texte ligne par ligne et retourne un tableau de lignes nettoyées
function readFileLines($fileName)
{
  $lines = array();
  $handle = fopen($fileName, "r");

  if (!$handle) {
    return $lines;
  }

  while (!feof($handle)) {
    $line = fgets($handle);
    if ($line !== false) {
      $lines[] = trim($line);
    }
  }

  fclose($handle);
  return $lines;
}

// Retourne le nom du fichier sans son extension
function getBaseFileName($fileName)
{
  $baseName = '';
  $length = strlen($fileName);

  for ($i = 0; $i < $length; $i++) {
    if ($fileName[$i] === '.') {
      break;
    }
    $baseName .= $fileName[$i];
  }

  return $baseName;
}

// Retourne la liste des fichiers PHP des exercices à tester
function getExerciseFileNames()
{
  $result = [];
  $files = scandir('.');

  for ($i = 0; $i < count($files); $i++) {
    $currentFile = $files[$i];
    // On ne prend que les fichiers PHP
    if (!containsSubstring($currentFile, '.php')) {
      continue;
    }
    // On exclut le runner et le loader éventuel
    if ($currentFile === 'air13.php' || $currentFile === 'test_loader.php') {
      continue;
    }
    $result[] = $currentFile;
  }

  return $result;
}

// Cherche si $subString est présent dans $mainString
function containsSubstring($mainString, $subString)
{
  $mainLength = strlen($mainString);
  $subLength = strlen($subString);
  $position = 0;

  while ($position <= $mainLength - $subLength) {
    $isMatch = true;
    for ($i = 0; $i < $subLength; $i++) {
      if ($mainString[$position + $i] !== $subString[$i]) {
        $isMatch = false;
        break;
      }
    }
    if ($isMatch) {
      return true;
    }
    $position++;
  }

  return false;
}

// ==========================
// Bloc Error Handling
// ==========================

function showError()
{
  echo "error\n";
  exit(1);
}

// ==========================
// Bloc Parsing
// ==========================

// Vide pour l’instant


// ==========================
// Bloc Resolution
// ==========================

function resolution()
{
  runTestsForAllExercises();
}

// ==========================
// Bloc Affichage
// ==========================

// Vide, les affichages sont dans les fonctions utilitaires


// Lancement principal
resolution();
