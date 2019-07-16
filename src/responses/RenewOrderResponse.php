<?php

namespace ProxyMakers\API\Responses;

/**
 * Class RenewOrderResponse.
 *
 * @author Pezhvak <pezhvak@imvx.org>
 *
 * @property object $price
 */
class RenewOrderResponse extends BaseResponse
{
    /**
     * Get Renew Price.
     *
     * amount that has been subtracted from your credit for your order
     *
     * @return float amount
     */
    public function getRenewPrice(): float
    {
        return $this->_data->price->amount;
    }

    /**
     * Get Order Price Currency.
     *
     * currency used for calculating order price
     *
     * @return string currency code
     */
    public function getOrderRenewCurrency(): string
    {
        return $this->_data->price->currency;
    }
}
