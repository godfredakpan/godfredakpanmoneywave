<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Exception\ValidationException;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\ValidateCardTransfer;
use PHPUnit\Framework\TestCase;

class ValidateCardTransferTest extends TestCase
{
    /** @var ValidateCardTransfer */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createValidateCardTransferService();
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
        $this->serviceObject->otp = '12345';
        $this->serviceObject->transactionRef = 'MW-REFERENCE';
        $this->assertTrue($this->serviceObject->validatePayload());
    }
}
