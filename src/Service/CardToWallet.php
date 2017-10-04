<?php

namespace godfredakpan\Moneywave\Service;

use godfredakpan\Moneywave\Enum\TransferRecipient;
use godfredakpan\Moneywave\Moneywave;

/**
 * Transfer funds from a card to a your Moneywave wallet.
 *
 * The chief premise of this solution is that you can charge any card in the world and pay into your wallet..
 *
 * @link https://moneywave-doc.herokuapp.com/index.html#card-to-wallet
 */
class CardToWallet extends CardTransfer
{
    /**
     * CardToWallet constructor.
     *
     * @param Moneywave $moneyWave
     */
    public function __construct(Moneywave $moneyWave)
    {
        parent::__construct($moneyWave);
        $this->requestData['recipient'] = TransferRecipient::WALLET;
    }
}
