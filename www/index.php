<?php

require_once('vendor/autoload.php');
require_once('config.php');

$conn = getConn();

$getNotifications = $conn->query("SELECT * FROM Avvisi WHERE DataScadenza >= NOW() ORDER BY DataScadenza DESC");

$notifications = array();
if ($getNotifications && $getNotifications->num_rows > 0) {
  while ($notification = $getNotifications->fetch_assoc()) {
    $notification["DataScadenza"] = date("d/m/Y", strtotime($notification["DataScadenza"]));
    $notifications[] = $notification;
  }
}

closeConn($conn);

$pug = new Pug();

$pug->displayFile('index.pug', [
  'avvisi' => $notifications,
  'iscrizioni' => [
    'Login' => LOGIN_ISCRIZIONI,
    'Register' => REGISTER_ISCRIZIONI
  ]
]);
