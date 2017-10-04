<?php

namespace godfredakpan\Moneywave\Service;

use godfredakpan\Moneywave\Enum\TransferRecipient;
use godfredakpan\Moneywave\Moneywave;

/**
 * Transfer funds from a bank account to a Moneywave wallet.
 *
 * The chief premise of this solution is that you can charge any bank account and deposit the funds to your wallet.
 *
 * @link https://moneywave-doc.herokuapp.com/index.html#account-to-wallet-access-bank-only
 */
class AccountToWallet extends AccountTransfer
{
    /**
     * AccountToWallet constructor.
     *
     * @param Moneywave $moneyWave
     */
    public function __construct(Moneywave $moneyWave)
    {
        parent::__construct($moneyWave);
        $this->requestData['recipient'] = TransferRecipient::WALLET;
    }
}
