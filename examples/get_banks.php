<?php

use godfredakpan\Moneywave\Moneywave;

require dirname(__DIR__).'/vendor/autoload.php';

$mw = new Moneywave();
$bankService = $mw->createBanksService();
$response = $bankService->send();
dump($response->getData());
