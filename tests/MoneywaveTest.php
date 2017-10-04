<?php

namespace godfredakpan\Moneywave\Tests;

use godfredakpan\Moneywave\Enum\Environment;
use godfredakpan\Moneywave\Moneywave;
use godfredakpan\Moneywave\Service\AccountNumberValidation;
use godfredakpan\Moneywave\Service\AccountToAccount;
use godfredakpan\Moneywave\Service\AccountToWallet;
use godfredakpan\Moneywave\Service\AccountTransfer;
use godfredakpan\Moneywave\Service\Banks;
use godfredakpan\Moneywave\Service\CardToBankAccount;
use godfredakpan\Moneywave\Service\CardTokenization;
use godfredakpan\Moneywave\Service\CardToWallet;
use godfredakpan\Moneywave\Service\CardTransfer;
use godfredakpan\Moneywave\Service\Disburse;
use godfredakpan\Moneywave\Service\DisburseBulk;
use godfredakpan\Moneywave\Service\InternetBankingToWallet;
use godfredakpan\Moneywave\Service\PreviousTransactionQuery;
use godfredakpan\Moneywave\Service\QueryDisbursement;
use godfredakpan\Moneywave\Service\RetryFailedTransfer;
use godfredakpan\Moneywave\Service\TotalChargeToCard;
use godfredakpan\Moneywave\Service\ValidateAccountTransfer;
use godfredakpan\Moneywave\Service\ValidateCardTransfer;
use godfredakpan\Moneywave\Service\VerifyMerchant;
use godfredakpan\Moneywave\Service\WalletBalance;
use PHPUnit\Framework\TestCase;

class MoneywaveTest extends TestCase
{
    /** @var Moneywave */
    private $moneywave;

    public function setUp()
    {
        $this->moneywave = new Moneywave(ACCESS_TOKEN, API_KEY, SECRET_KEY, Environment::STAGING);
    }

    /**
     * @param $className
     * @param $expected
     *
     * @dataProvider serviceDataProvider
     */
    public function testCreateService($className, $expected)
    {
        $method = 'create'.$className.'Service';
        $serviceObject = $this->moneywave->{$method}();
        $this->assertInstanceOf($expected, $serviceObject);

        return $serviceObject;
    }

    public function testGetApiKey()
    {
        $this->assertEquals(API_KEY, $this->moneywave->getApiKey());
    }

    public function testGetSecretKey()
    {
        $this->assertEquals(SECRET_KEY, $this->moneywave->getSecretKey());
    }

    public function testGetAccessToken()
    {
        $this->assertEquals(ACCESS_TOKEN, $this->moneywave->getAccessToken());
    }

    /**
     * A data provider for the services and their matching classes.
     *
     * @return array
     */
    public function serviceDataProvider()
    {
        return [
            'account validation'        => ['AccountNumberValidation', AccountNumberValidation::class],
            'account to account'        => ['AccountToAccount', AccountToAccount::class],
            'account to wallet'         => ['AccountToWallet', AccountToWallet::class],
            'account transfer'          => ['AccountTransfer', AccountTransfer::class],
            'banks'                     => ['Banks', Banks::class],
            'card to bank'              => ['CardToBankAccount', CardToBankAccount::class],
            'card to wallet'            => ['CardToWallet', CardToWallet::class],
            'card transfer'             => ['CardTransfer', CardTransfer::class],
            'card tokenization'         => ['CardTokenization', CardTokenization::class],
            'disburse'                  => ['Disburse', Disburse::class],
            'disburse bulk'             => ['DisburseBulk', DisburseBulk::class],
            'internet banking'          => ['InternetBankingToWallet', InternetBankingToWallet::class],
            'previous transaction query'=> ['PreviousTransactionQuery', PreviousTransactionQuery::class],
            'query disbursement'        => ['QueryDisbursement', QueryDisbursement::class],
            'retry failed transfer'     => ['RetryFailedTransfer', RetryFailedTransfer::class],
            'total charge to card'      => ['TotalChargeToCard', TotalChargeToCard::class],
            'validate card transfer'    => ['ValidateCardTransfer', ValidateCardTransfer::class],
            'validate account transfer' => ['ValidateAccountTransfer', ValidateAccountTransfer::class],
            'verify merchant'           => ['VerifyMerchant', VerifyMerchant::class],
            'wallet balance'            => ['WalletBalance', WalletBalance::class],
        ];
    }
}
