<?php

require_once('vendor/autoload.php');

$eventi = array();
foreach (array_slice(array_diff(scandir('./files/eventi', 1), array('..', '.')), 0, 3) as $file) {
  $tokens = explode('_', str_replace('.jpg', '', $file));
  $day = $tokens[0];
  $youtubeURI = sizeof($tokens) > 1 ? $tokens[1] : NULL;

  $eventi[] = [
    'File' => './files/eventi/' . $file,
    'Giorno' => (new DateTimeImmutable($day))->format('d/m/Y'),
    'Link' => $youtubeURI ? 'https://youtu.be/' . $youtubeURI : NULL
  ];
}

$pug = new Pug();

$pug->displayFile('attivita.pug', [
  'eventi' => $eventi,
]);
