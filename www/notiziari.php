<?php

require_once('vendor/autoload.php');
require_once('config.php');
require_once('utils.php');

$notiziari = array();
foreach (array_diff(scandir('./files/notiziari', 1), array('..', '.')) as $file) {
  $tokens = explode('-', $file);
  $year = $tokens[0];

  $months = explode('_', $tokens[1]);
  $months = array_map('toMonth', $months);

  $notiziari[] = [
    'Mesi' => joinMonths($months),
    'Titolo' => '"Sui Tuoi Passi", ' . joinMonths($months) . " $year",
    'Link' => './files/notiziari/' . $file
  ];
}

closeConn($conn);

$pug = new Pug();

$pug->displayFile('notiziari.pug', [
  'notiziari' => $notiziari,
]);
