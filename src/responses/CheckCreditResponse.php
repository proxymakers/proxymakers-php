<?php

namespace ProxyMakers\API\Responses;

/**
 * Class CheckCreditResponse.
 *
 * @author Pezhvak <pezhvak@imvx.org>
 *
 * @property float $credit amount of the credit available
 * @property string $currency currency of the balance
 */
class CheckCreditResponse extends BaseResponse
{
    /**
     * Get Credit
     * amount of the credit available in your account.
     *
     * @return float
     */
    public function getCredit(): float
    {
        return $this->_data->credit;
    }

    /**
     * Get Currency
     * get currency of the balance.
     *
     * @return string currency code of the balance
     */
    public function getCurrency(): string
    {
        return $this->_data->currency;
    }
}
