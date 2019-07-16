<?php

namespace ProxyMakers\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use ProxyMakers\API\Exceptions\TokenNotSetException;
use ProxyMakers\API\Responses\CalculateOrderPriceResponse;
use ProxyMakers\API\Responses\CheckCreditResponse;
use ProxyMakers\API\Responses\GetOrderDetailsResponse;
use ProxyMakers\API\Responses\ListOrdersResponse;
use ProxyMakers\API\Responses\OrderProxyResponse;
use ProxyMakers\API\Responses\RenewOrderResponse;
use ProxyMakers\API\Responses\SetOrderStatusResponse;
use ProxyMakers\API\Responses\UpdateOrderSettingsResponse;

/**
 * Class ProxyMakers.
 *
 * @author Pezhvak <pezhvak@imvx.org>
 *
 * @see https://proxymakers.com/developers
 */
class ProxyMakers
{
    const BASE_URL = 'https://proxymakers.com/api/';
    private $_token;
    private $_client;

    /**
     * ProxyMakers constructor.
     *
     * @param string $token
     *
     * @throws TokenNotSetException
     */
    public function __construct(string $token)
    {
        if (empty($token)) {
            $this->_throwInvalidTokenException();
        }
        $this->_token = $token;
    }

    /**
     * @throws TokenNotSetException
     */
    private function _throwInvalidTokenException(): void
    {
        throw new TokenNotSetException('Please provide a valid token');
    }

    /**
     * Check Credit.
     *
     * using this endpoint you can check how much credit your account has.
     *
     * @see https://proxymakers.com/developers#check_credit
     *
     * @throws TokenNotSetException
     *
     * @return CheckCreditResponse
     */
    public function checkCredit(): CheckCreditResponse
    {
        return new CheckCreditResponse($this->_call('GET', 'account/credit'));
    }

    /**
     * Call API Endpoint.
     *
     * @param string     $method
     * @param string     $endpoint
     * @param array|null $data
     *
     * @throws TokenNotSetException
     *
     * @return mixed
     */
    private function _call(string $method, string $endpoint, array $data = null)
    {
        $headers = [
            'Authorization' => 'Bearer '.$this->_token,
            'Accept'        => 'application/json',
        ];
        if (!isset($this->_client)) {
            $this->_client = new Client(['headers' => $headers]);
        }
        $response = '';

        try {
            if (is_null($data)) {
                $response = $this->_client->$method(self::BASE_URL.$endpoint);
            } else {
                $response = $this->_client->$method(self::BASE_URL.$endpoint, ['form_params' => $data]);
            }
        } catch (ClientException $exception) {
            switch ($exception->getCode()) {
                case 401:
                    {
                        $this->_throwInvalidTokenException();
                    }
                    break;
                default:
                    {
                        throw $exception;
                    }
            }
        }

        return $response;
    }

    /**
     * Calculate Order Price.
     *
     * there is no easy way to calculate our prices on your own, it depends on membership rank, quantity, period and
     * type of the proxies being ordered. using this endpoint enables you to calculate the order price easily.
     *
     * @see https://proxymakers.com/developers#calculate_order_price
     *
     * @param string $service  the service you want to calculate prices for, can be 'proxy_ipv4' or 'proxy_ipv6'
     * @param int    $quantity quantity of the given service
     * @param int    $period   amount in days for the service to be ordered/renewed, minimum is 1 and maximum is 90 days
     * @param string $intent   this can be either 'order' or 'renew', by default it's 'order', used for rank calculation
     *
     * @throws TokenNotSetException
     *
     * @return CalculateOrderPriceResponse
     */
    public function calculateOrderPrice(string $service, int $quantity, int $period, string $intent = 'order')
    {
        return new CalculateOrderPriceResponse($this->_call('POST', 'order/price/calculate',
            compact('service', 'quantity', 'period', 'intent')));
    }

    /**
     * Order Proxy.
     *
     * using this endpoint you can register new proxies.
     *
     * @see https://proxymakers.com/developers#order_proxies
     *
     * @param string $service  the service you want to calculate prices for, can be 'proxy_ipv4' or 'proxy_ipv6'
     * @param string $geo      location of the ip, for now it can be 'US' or 'DE'
     * @param int    $quantity quantity of the given service
     * @param int    $period   amount in days for the service to be ordered/renewed, minimum is 1 and maximum is 90 days
     * @param string $schedule this can be 'none', 'first_available', 'round_robin', 'random_choice' or 'least_connection'; default is 'none'
     *
     * @throws TokenNotSetException
     *
     * @return OrderProxyResponse
     */
    public function orderProxy(string $service, string $geo, int $quantity, int $period,
                               string $schedule = 'none'): OrderProxyResponse
    {
        return new OrderProxyResponse($this->_call('POST', 'orders',
            compact('service', 'geo', 'quantity', 'period', 'schedule')));
    }

    /**
     * Renew Order.
     *
     * using this endpoint you can renew your order.
     *
     * @see https://proxymakers.com/developers#renew_order
     *
     * @param string $order_id id of the order to be renewed
     * @param int    $period   amount in days for the service to be renewed, minimum is 1 and maximum is 90 days
     *
     * @throws TokenNotSetException
     *
     * @return RenewOrderResponse
     */
    public function renewOrder(string $order_id, int $period): RenewOrderResponse
    {
        return new RenewOrderResponse($this->_call('POST', "orders/{$order_id}/renew",
            compact('period')));
    }

    /**
     * List Orders.
     *
     * by using this endpoint you can retrieve a list of your orders.
     *
     * @see https://proxymakers.com/developers#list_orders
     *
     * @throws TokenNotSetException
     *
     * @return ListOrdersResponse
     */
    public function listOrders(): ListOrdersResponse
    {
        return new ListOrdersResponse($this->_call('GET', 'orders'));
    }

    /**
     * Get Order Details.
     *
     * by using this endpoint you can retrieve details of the given order
     *
     * @see https://proxymakers.com/developers#order_details
     *
     * @param string $order_id
     *
     * @throws TokenNotSetException
     *
     * @return GetOrderDetailsResponse
     */
    public function getOrderDetails(string $order_id): GetOrderDetailsResponse
    {
        return new GetOrderDetailsResponse($this->_call('GET', "orders/{$order_id}"));
    }

    /**
     * Update Order Settings.
     *
     * to set an alias for your order, change schedule algorithm or auto renew status you can use this endpoint.
     *
     * @see https://proxymakers.com/developers#order_settings
     *
     * @param string      $order_id
     * @param string|null $name
     * @param bool|null   $auto_renew
     * @param string|null $schedule
     *
     * @throws TokenNotSetException
     *
     * @return UpdateOrderSettingsResponse
     */
    public function updateOrderSettings(string $order_id, string $name = null, bool $auto_renew = null,
                                        string $schedule = null): UpdateOrderSettingsResponse
    {
        return new UpdateOrderSettingsResponse($this->_call('POST',
            "orders/{$order_id}/settings", compact('name', 'auto_renew', 'schedule')));
    }

    /**
     * Update Order Status.
     *
     * using this endpoint you can stop or start your order, useful for restarting proxies as well.
     *
     * @see https://proxymakers.com/developers#set_order_status
     *
     * @param string $order_id
     * @param bool   $active
     *
     * @throws TokenNotSetException
     *
     * @return SetOrderStatusResponse
     */
    public function setOrderStatus(string $order_id, bool $active): SetOrderStatusResponse
    {
        return new SetOrderStatusResponse($this->_call('POST',
            "orders/{$order_id}/status", [
                'status' => $active ? 'active' : 'stopped',
            ]));
    }
}
