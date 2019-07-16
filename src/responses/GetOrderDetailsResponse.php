<?php

namespace ProxyMakers\API\Responses;

/**
 * Class GetOrderDetailsResponse
 * @package ProxyMakers\API\Responses
 * @author Pezhvak <pezhvak@imvx.org>
 * @property array $proxies list of all proxies of this order
 */
class GetOrderDetailsResponse extends BaseResponse
{
    /**
     * Get Proxies
     *
     * array of all proxies
     *
     * @return array
     */
    public function getProxies(): array
    {
        return $this->_data->proxies;
    }
}