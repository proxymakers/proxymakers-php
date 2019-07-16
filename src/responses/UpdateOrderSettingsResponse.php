<?php

namespace ProxyMakers\API\Responses;

/**
 * Class UpdateOrderSettingsResponse
 * @package ProxyMakers\API\Responses
 * @author Pezhvak <pezhvak@imvx.org>
 * @property object $details
 */
class UpdateOrderSettingsResponse extends BaseResponse
{
    /**
     * Get Proxy Details
     *
     * get updated proxy details
     *
     * @return mixed
     */
    public function getProxyDetails()
    {
        return $this->_data->details;
    }
}