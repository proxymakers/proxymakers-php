<?php

namespace ProxyMakers\API\Responses;

/**
 * Class ListOrdersResponse.
 *
 * @author Pezhvak <pezhvak@imvx.org>
 *
 * @property array $orders list of all orders
 */
class ListOrdersResponse extends BaseResponse
{
    /**
     * Get Orders.
     *
     * array of all orders
     *
     * @return array
     */
    public function getOrders(): array
    {
        return $this->_data->orders;
    }
}
