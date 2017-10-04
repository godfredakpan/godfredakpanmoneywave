<?php

namespace godfredakpan\Moneywave\Tests\Service;

use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\WalletBalance;
use PHPUnit\Framework\TestCase;

class WalletBalanceTest extends TestCase
{
    /** @var WalletBalance */
    private $serviceObject;

    public function setUp()
    {
        $moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
        $this->serviceObject = $moneywave->createWalletBalanceService();
    }

    public function testRequestMethod()
    {
        $this->assertEquals('get', strtolower($this->serviceObject->getRequestMethod()));
    }

    public function testPassValidation()
    {
        $this->assertTrue($this->serviceObject->validatePayload());
    }
}
