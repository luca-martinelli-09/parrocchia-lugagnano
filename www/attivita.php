<?php

require_once('vendor/autoload.php');

$eventi = array();
foreach (array_slice(array_diff(scandir('./files/eventi', 1), array('..', '.')), 0, 3) as $file) {
  $tokens = explode('_', str_replace('.jpg', '', $file));
  $day = $tokens[0];
  $youtubeURI = $tokens[1];

  $eventi[] = [
    'File' => './files/eventi/' . $file,
    'Giorno' => (new DateTimeImmutable($day))->format('d/m/Y'),
    'Link' => 'https://youtu.be/' . $youtubeURI
  ];
}

$pug = new Pug();

$pug->displayFile('attivita.pug', [
  'eventi' => $eventi,
]);
