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

$altro = array();
foreach (array_slice(array_diff(scandir('./files/altro', 1), array('..', '.')), 0, 3) as $file) {
  $data = substr($file, 0, 10);
  $title = substr($file, 12);

  $altro[] = [
    'Data' => (new DateTimeImmutable($data))->format('d/m/Y'),
    'Titolo' => pathinfo($title, PATHINFO_FILENAME),
    'Link' => './files/altro/' . $file
  ];
}

closeConn($conn);

$pug = new Pug();

$pug->displayFile('index.pug', [
  'avvisi' => $notifications,
  'notiziari' => $notiziari,
  'eventi' => $eventi,
  'altro' => $altro,
  'iscrizioni' => [
    'Login' => LOGIN_ISCRIZIONI,
    'Register' => REGISTER_ISCRIZIONI
  ],
  'day' => intval(date("md"))
]);
