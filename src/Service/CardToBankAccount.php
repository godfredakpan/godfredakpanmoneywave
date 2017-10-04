<?php

namespace godfredakpan\Moneywave\Service;

use godfredakpan\Moneywave\Enum\TransferRecipient;
use godfredakpan\Moneywave\Moneywave;

/**
 * Transfer funds from a card to a bank account.
 *
 * The chief premise of this solution is that you can charge any card in the world and pay any bank account in
 * supported countries.
 *
 *
 * @link https://moneywave-doc.herokuapp.com/index.html#card-to-account
 */
class CardToBankAccount extends CardTransfer
{
    /**
     * CardToBankAccount constructor.
     *
     * @param Moneywave $moneyWave
     */
    public function __construct(Moneywave $moneyWave)
    {
        parent::__construct($moneyWave);
        $this->requestData['recipient'] = TransferRecipient::ACCOUNT;
        $required = array_merge($this->getRequiredFields(), [
            'recipient_bank',
            'recipient_account_number',
        ]);
        $this->setRequiredFields(...$required);
    }
}
