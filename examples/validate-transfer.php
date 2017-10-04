<?php

use godfredakpan\Moneywave\Enum\AuthorizationType;
use godfredakpan\Moneywave\Exception\ValidationException;
use godfredakpan\Moneywave\Moneywave;

require dirname(__DIR__).'/vendor/autoload.php';
session_start();

try {
    $accessToken = !empty($_SESSION['accessToken']) ? $_SESSION['accessToken'] : null;
    $mw = new Moneywave($accessToken);
    $_SESSION['accessToken'] = $mw->getAccessToken();
    $validateTransfer = $mw->createValidateTransferService();
    $validateTransfer->transactionRef = '';
    $validateTransfer->authType = AuthorizationType::OTP;
    $validateTransfer->authValue = '12345';
    $response = $validateTransfer->send();
    dump($response->getData());
    dump($response->getMessage());
} catch (ValidationException $e) {
    dump($e->getMessage());
}
