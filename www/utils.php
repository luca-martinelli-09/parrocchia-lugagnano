<?php

function toMonth($m) {
  $monthConverter = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

  return $monthConverter[intval($m) - 1];
}

function joinMonths($months) {
  if (sizeof($months) == 1) {
    return $months[0];
  }

  $firsts = array_slice($months, 0, sizeof($months) - 1);
  return implode(' e ', [implode(', ', $firsts), $months[sizeof($months) - 1]]);
}
