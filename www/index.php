<?php

require_once('vendor/autoload.php');
require_once('config.php');
require_once('utils.php');

$conn = getConn();

$getNotifications = $conn->query("SELECT * FROM Avvisi WHERE DataScadenza >= NOW() ORDER BY DataScadenza ASC");

$notifications = array();
if ($getNotifications && $getNotifications->num_rows > 0) {
  while ($notification = $getNotifications->fetch_assoc()) {
    $notification["DataScadenza"] = date("d/m/Y", strtotime($notification["DataScadenza"]));
    $notifications[] = $notification;
  }
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

$eventi = array();
foreach (array_diff(scandir('./files/eventi', 1), array('..', '.')) as $file) {
  $tokens = explode('_', str_replace('.jpg', '', $file));
  $day = $tokens[0];
  $youtubeURI = sizeof($tokens) > 1 ? join('_', array_slice($tokens, 1)) : NULL;

  if (strtotime($day) >= time() - 86400) {
    $eventi[] = [
      'File' => './files/eventi/' . $file,
      'Giorno' => (new DateTimeImmutable($day))->format('d/m/Y'),
      'Link' => $youtubeURI ? 'https://youtu.be/' . $youtubeURI : NULL
    ];
  }
}

closeConn($conn);

$pug = new Pug();

$pug->displayFile('index.pug', [
  'avvisi' => $notifications,
  'notiziari' => $notiziari,
  'eventi' => $eventi,
  'iscrizioni' => [
    'Login' => LOGIN_ISCRIZIONI,
    'Register' => REGISTER_ISCRIZIONI
  ],
  'day' => intval(date("md"))
]);
