<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Banks;
use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Enum\PaymentMedium;
use godfredakpan\Moneywave\Exception\ValidationException;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\InternetBankingToWallet;
use PHPUnit\Framework\TestCase;

/**
 * Class InternetBankingToWalletTest
 * @package godfredakpan\Moneywave\Tests\Service
 *
 * @link https://moneywave-doc.herokuapp.com/index.html#pay-with-internet-banking
 */
class InternetBankingToWalletTest extends TestCase
{
    /** @var InternetBankingToWallet */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createInternetBankingToWalletService();
    }

    public function testRequestMethod()
    {
        $this->assertEquals('post', strtolower($this->serviceObject->getRequestMethod()));
    }

    public function testFailsValidation()
    {
        $this->expectException(ValidationException::class);
        $this->serviceObject->validatePayload();
    }

    public function testUnsupportedBankValidation()
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->serviceObject->firstname = 'firstname';
        $this->serviceObject->lastname = 'lastname';
        $this->serviceObject->phonenumber = '+2348123456789';
        $this->serviceObject->email = 'username@domain.com';
        $this->serviceObject->amount = 10;
        $this->serviceObject->redirect_url = 'localhost:8000';
        $this->serviceObject->medium = PaymentMedium::MOBILE;
        $this->serviceObject->sender_bank = Banks::GTBANK_MOBILE_MONEY;
        $this->serviceObject->send();
    }

    public function testPassValidation()
    {
        $this->serviceObject->firstname = 'firstname';
        $this->serviceObject->lastname = 'lastname';
        $this->serviceObject->phonenumber = '+2348123456789';
        $this->serviceObject->email = 'username@domain.com';
        $this->serviceObject->amount = 10;
        $this->serviceObject->redirecturl = 'localhost:8000';
        $this->serviceObject->medium = PaymentMedium::MOBILE;
        $this->serviceObject->sender_bank = Banks::GTBANK;
        $this->assertTrue($this->serviceObject->validatePayload());
    }
}
