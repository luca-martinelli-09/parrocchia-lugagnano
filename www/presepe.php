<?php

require_once('vendor/autoload.php');
require_once('config.php');
require_once('utils.php');

closeConn($conn);

$pug = new Pug();

$pug->displayFile('presepe.pug');
