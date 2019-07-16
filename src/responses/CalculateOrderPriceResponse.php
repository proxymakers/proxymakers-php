<?php

namespace ProxyMakers\API\Responses;

/**
 * Class CalculateOrderPriceResponse
 * @package ProxyMakers\API\Responses
 * @author Pezhvak <pezhvak@imvx.org>
 * @property object $user
 * @property object $prices
 */
class CalculateOrderPriceResponse extends BaseResponse
{
    /**
     * Get Credit
     * amount of the credit available in your account
     *
     * @return float
     */
    public function getCredit(): float
    {
        return $this->_data->user->credit;
    }

    /**
     * Get Currency
     * get currency of the balance
     *
     * @return string currency code of the balance
     */
    public function getCurrency(): string
    {
        return $this->_data->user->currency;
    }

    /**
     * Get Order Price
     * credit required to order given resources
     *
     * @return float price
     */
    public function getOrderPrice(): float
    {
        return $this->_data->prices->order;
    }

    /**
     * Get Renew Price
     * credit required to renew given resources
     *
     * @return float amount
     */
    public function getRenewPrice(): float
    {
        return $this->_data->prices->renew;
    }

    /**
     * Get Price Rank
     * the rank that price has been calculated for
     *
     * @return string price rank
     */
    public function getPriceRank(): string
    {
        return $this->_data->prices->rank;
    }
}