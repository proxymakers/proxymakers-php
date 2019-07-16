<?php

namespace ProxyMakers\API\Responses;

/**
 * Class OrderProxyResponse
 * @package ProxyMakers\API\Responses
 * @author Pezhvak <pezhvak@imvx.org>
 * @property object $order
 * @property object $price
 */
class OrderProxyResponse extends BaseResponse
{
    /**
     * Get Order Price
     *
     * amount that has been subtracted from your credit for your order
     *
     * @return float amount
     */
    public function getOrderPrice(): float
    {
        return $this->_data->price->amount;
    }

    /**
     * Get Order Price Currency
     *
     * currency used for calculating order price
     *
     * @return string currency code
     */
    public function getOrderPriceCurrency(): string
    {
        return $this->_data->price->currency;
    }

    /**
     * Get Order Id
     *
     * get the created order id
     *
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->_data->order->order_id;
    }
}