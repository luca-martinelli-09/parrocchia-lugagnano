<?php

require_once('vendor/autoload.php');

$comunicazioni = array();
foreach (array_slice(array_diff(scandir('./files/comunicazioni', 1), array('..', '.')), 0, 3) as $file) {
  $data = substr($file, 0, 10);
  $title = substr($file, 12);

  $comunicazioni[] = [
    'Data' => (new DateTimeImmutable($data))->format('d/m/Y'),
    'Titolo' => pathinfo($title, PATHINFO_FILENAME),
    'Link' => './files/comunicazioni/' . $file
  ];
}

$pug = new Pug();

$pug->displayFile('comunicazioni.pug', [
  'comunicazioni' => $comunicazioni,
]);
