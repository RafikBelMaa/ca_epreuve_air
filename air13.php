<?php

// Utilitaire


// Error handling

function showError()
{
  echo "error\n";
  exit;
}

// Parsing
function loadTests()
{
  return [

    // 🟢 air00 — split avec séparateurs multiples
    ['file' => 'air00.php', 'args' => ['bonjour', 'les', 'amis', ','], 'expected' => "bonjour\nles\namis"],
    ['file' => 'air00.php', 'args' => ['je', 'suis', 'ici', '.'], 'expected' => "je\nsuis\nici"],

    // 🔴 air01 — split avec sous-chaîne
    ['file' => 'air01.php', 'args' => ['Hello<SEP>World<SEP>!', '<SEP>'], 'expected' => "Hello\nWorld\n!"],
    ['file' => 'air01.php', 'args' => ['unDEUXtroisDEUXquatre', 'DEUX'], 'expected' => "un\ntrois\nquatre"],

    // 🟢 air02 — join
    ['file' => 'air02.php', 'args' => ['je', 'suis', 'beau', '_'], 'expected' => "je_suis_beau"],
    ['file' => 'air02.php', 'args' => ['1', '2', '3', '4', '-'], 'expected' => "1-2-3-4"],

    // 🔴 air03 — valeur sans paire
    ['file' => 'air03.php', 'args' => ['bonjour', 'salut', 'bonjour'], 'expected' => "salut"],
    ['file' => 'air03.php', 'args' => ['1', '2', '3', '2', '1'], 'expected' => "3"],

    // 🟢 air04 — supprime doublons adjacents
    ['file' => 'air04.php', 'args' => ['Hello   world'], 'expected' => "Helo world"],
    ['file' => 'air04.php', 'args' => ['aaabbbcccaaa'], 'expected' => "abca"],

    // 🔴 air05 — opération sur liste
    ['file' => 'air05.php', 'args' => ['1', '2', '3', '4', '5', '+2'], 'expected' => "3 4 5 6 7"],
    ['file' => 'air05.php', 'args' => ['10', '20', '30', '*2'], 'expected' => "20 40 60"],

    // 🟢 air06 — filtre
    ['file' => 'air06.php', 'args' => ['Michel', 'Albert', 'Thérèse', 'Benoit', 't'], 'expected' => "Michel,Albert,Thérèse,"],
    ['file' => 'air06.php', 'args' => ['Rafik', 'Émile', 'Lucas', 'Sofiane', 'z'], 'expected' => "Rafik,Émile,Lucas,Sofiane,"],

    // 🔴 air07 — insertion dans liste triée
    ['file' => 'air07.php', 'args' => ['1', '3', '5', '4'], 'expected' => "1\n3\n4\n5\n"],
    ['file' => 'air07.php', 'args' => ['10', '20', '30', '25'], 'expected' => "10\n20\n25\n30\n"],

    // 🟢 air08 — fusion
    ['file' => 'air08.php', 'args' => ['1', '2', '3', 'fusion', '4', '5', '6'], 'expected' => "1\n2\n3\n4\n5\n6\n"],
    ['file' => 'air08.php', 'args' => ['10', '30', 'fusion', '15', '25'], 'expected' => "10\n15\n25\n30\n"],

    // 🔴 air09 — rotation
    ['file' => 'air09.php', 'args' => ['un', 'deux', 'trois'], 'expected' => "Rotation Numéro :  1 deux, trois, un\nRotation Numéro :  2 trois, un, deux\n"],
    ['file' => 'air09.php', 'args' => ['Michel', 'Albert', 'Thérèse', 'Benoit'], 'expected' => "Rotation Numéro :  1 Albert, Thérèse, Benoit, Michel\nRotation Numéro :  2 Thérèse, Benoit, Michel, Albert\nRotation Numéro :  3 Benoit, Michel, Albert, Thérèse\n"],

    // 🟢 air10 — lecture fichier (attention à adapter en local !)
    ['file' => 'air10.php', 'args' => ['air10_test.txt'], 'expected' => "je suis un test\n"],

    // 🔴 air11 — escalier
    ['file' => 'air11.php', 'args' => ['O', '3'], 'expected' => "  O\n OOO\nOOOOO\n"],

    // 🟢 air12 — quick sort
    ['file' => 'air12.php', 'args' => ['6', '5', '4', '3', '2', '1'], 'expected' => "1 2 3 4 5 6"],
    ['file' => 'air12.php', 'args' => ['9', '7', '8', '10'], 'expected' => "7 8 9 10"],
  ];
}


// resolution


// Affichage