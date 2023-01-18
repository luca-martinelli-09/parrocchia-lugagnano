<?php

require_once('vendor/autoload.php');

$eventi = array();
foreach (array_diff(scandir('./files/eventi', 1), array('..', '.')) as $file) {
  $tokens = explode('_', str_replace('.jpg', '', $file));
  $day = $tokens[0];
  $youtubeURI = sizeof($tokens) > 1 ? join('_', array_slice($tokens, 1)) : NULL;

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
