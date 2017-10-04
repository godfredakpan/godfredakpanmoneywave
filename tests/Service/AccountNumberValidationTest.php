<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Banks;
use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Exception\ValidationException;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\AccountNumberValidation;
use PHPUnit\Framework\TestCase;

class AccountNumberValidationTest extends TestCase
{
    /** @var AccountNumberValidation */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createAccountNumberValidationService();
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
        $this->serviceObject->account_number = '0123456789';
        $this->serviceObject->bank_code = Banks::ASO_SAVINGS_AND_LOANS;
        $this->assertTrue($this->serviceObject->validatePayload());
    }
}
