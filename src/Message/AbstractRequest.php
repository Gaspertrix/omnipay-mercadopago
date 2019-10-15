<?php

namespace Omnipay\MercadoPago\Message;

use MercadoPago;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.mercadopago.com';
    protected $testEndpoint = 'https://api.mercadopago.com';

    /**
     * 
     * @return string
     */
    public function getClientId()
    {
        return $this->getParameter('client_id');
    }

    /**
     * @param string $value
     */
    public function setClientId($value)
    {
        return $this->setParameter('client_id', $value);
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->getParameter('client_secret');
    }

    /**
     * @param string $value
     */
    public function setClientSecret($value)
    {
        return $this->setParameter('client_secret', $value);
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->getParameter('access_token');
    }

    /**
     * @param string $value
     */
    public function setAccessToken($value)
    {
        return $this->setParameter('access_token', $value);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('access_token');

        if ($this->getAccessToken()) {
            MercadoPago\SDK::setAccessToken($this->getAccessToken());
        }
        else if ($this->getClientId() AND $this->getClientSecret() AND !$this->getAccessToken()) {
            MercadoPago\SDK::setClientId($this->getClientId());
            MercadoPago\SDK::setClientSecret($this->getClientSecret());
        }

        return [];
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint() . '?access_token=' . $this->getAccessToken();
        $httpRequest = $this->httpClient->request(
            'POST',
            $url,
            array(
                'Content-type' => 'application/json',
            ),
            $this->toJSON($data)
        );
        dd($httpRequest->getBody()->getContents());
        return $this->createResponse(json_decode($httpRequest->getBody()->getContents()));
    }
}
