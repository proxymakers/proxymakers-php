<?php

namespace ProxyMakers\API\Responses;

use function GuzzleHttp\json_decode as jdecode;
use Mockery\Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BaseResponse.
 *
 * @author Pezhvak <pezhvak@imvx.org>
 */
class BaseResponse
{
    protected $_data;
    protected $_responseObject;
    private $_response;

    public function __construct(ResponseInterface $response)
    {
        $this->_response = $response;

        try {
            $this->_responseObject = jdecode($response->getBody()->getContents());
            $this->_data = $this->_responseObject->data;
        } catch (Exception $exception) {
            $this->_data = $response->getBody()->getContents();
        }
    }

    /**
     * Get Response Data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Get Response Interface.
     *
     * @return ResponseInterface
     */
    public function getResponseInterface()
    {
        return $this->_response;
    }

    /**
     * Get Response Object
     * this method returns json decoded response from server.
     *
     * @return mixed
     */
    public function getResponseObject()
    {
        return $this->_responseObject;
    }

    /**
     * Get Response Status.
     *
     * @return string response status
     */
    public function getStatus(): string
    {
        return $this->_responseObject->status;
    }

    /**
     * Get HTTP Status Code.
     *
     * @return int http status code
     */
    public function getStatusCode()
    {
        return $this->_response->getStatusCode();
    }

    public function __get($name)
    {
        return $this->_data->$name ?? '';
    }
}
