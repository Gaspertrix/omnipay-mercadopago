<?php

namespace Omnipay\MercadoPago;

use Omnipay\Common\AbstractGateway;
use Omnipay\MercadoPago\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'MercadoPago';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'client_id' => '',
            'client_secret' => '',
            'access_token' => '',
        );
    }

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
     * @param  array  $parameters
     * @return Omnipay\MercadoPago\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}
