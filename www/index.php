<?php

require_once('vendor/autoload.php');
require_once('config.php');

$conn = getConn();

$getNotifications = $conn->query("SELECT * FROM Avvisi WHERE DataScadenza >= NOW() ORDER BY DataScadenza ASC");

$notifications = array();
if ($getNotifications && $getNotifications->num_rows > 0) {
  while ($notification = $getNotifications->fetch_assoc()) {
    $notification["DataScadenza"] = date("d/m/Y", strtotime($notification["DataScadenza"]));
    $notifications[] = $notification;
  }
}

function toMonth($m) {
  $monthConverter = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

  return $monthConverter[intval($m) - 1];
}

function joinMonths($months) {
  $firsts = array_slice($months, 0, sizeof($months) - 1);
  return implode(' e ', [implode(', ', $firsts), $months[sizeof($months) - 1]]);
}

$notiziari = array();
foreach (array_slice(array_diff(scandir('./files/notiziari', 1), array('..', '.')), 0, 3) as $file) {
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

$pug->displayFile('index.pug', [
  'avvisi' => $notifications,
  'notiziari' => $notiziari,
  'iscrizioni' => [
    'Login' => LOGIN_ISCRIZIONI,
    'Register' => REGISTER_ISCRIZIONI
  ]
]);
