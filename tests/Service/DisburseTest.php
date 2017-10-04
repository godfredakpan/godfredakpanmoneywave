<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Banks;
use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Exception\ValidationException;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\Disburse;
use PHPUnit\Framework\TestCase;

class DisburseTest extends TestCase
{
    /** @var Disburse */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createDisburseService();
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

    public function testPassValidation()
    {
        $this->serviceObject->lock = 'wallet password';
        $this->serviceObject->bankcode = Banks::DIAMOND_BANK;
        $this->serviceObject->accountNumber = '0123456789';
        $this->serviceObject->senderName = 'Moneywave Sender';
        $this->serviceObject->amount = 50;
        $this->assertTrue($this->serviceObject->validatePayload());
    }
}
