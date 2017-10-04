<?php

namespace godfredakpan\Moneywave\Tests\Enum;

use godfredakpan\Moneywave\Enum\Banks;
use PHPUnit\Framework\TestCase;

class BanksTest extends TestCase
{
    public function testGetSupportedBanks()
    {
        $banks = Banks::getSupportedBanks();
        $this->assertNotEmpty($banks);
    }
}
