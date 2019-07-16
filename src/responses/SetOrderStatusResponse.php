<?php

namespace ProxyMakers\API\Responses;

/**
 * Class SetOrderStatusResponse.
 *
 * @author Pezhvak <pezhvak@imvx.org>
 *
 * @property string $status
 */
class SetOrderStatusResponse extends BaseResponse
{
    /**
     * Get Updated Status.
     *
     * get updated status
     *
     * @return string
     */
    public function getUpdatedStatus(): string
    {
        return $this->_data->status;
    }
}
