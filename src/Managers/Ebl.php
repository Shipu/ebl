<?php

namespace Shipu\Ebl\Managers;

use Shipu\Ebl\Apis\Session;
use Shipu\Ebl\Apis\Tokenized;
use Shipu\Ebl\Apis\Transaction;

class Ebl
{
    /**
     * @var
     */
    protected $config;

    /**
     *
     * @var Session
     */
    protected $sessionApi;

    /**
     *
     * @var Transaction
     */
    protected $transactionApi;

    /**
     *
     * @var Tokenized
     */
    protected $tokenizedApi;

    /**
     * EblManager constructor.
     *
     * @param $config
     */
    public function __construct( $config )
    {
        $this->config = $config;

        $this->sessionApi = new Session($config);
        $this->transactionApi = new Transaction($config);
        $this->tokenizedApi = new Tokenized($config);
    }

    public function session()
    {
        return $this->sessionApi;
    }

    public function tokenized()
    {
        return $this->tokenizedApi;
    }

    public function transaction()
    {
        return $this->transactionApi;
    }

    public function amount( $amount )
    {
        $this->sessionApi->amount($amount);

        return $this;
    }

    public function orderId( $orderId )
    {
        $this->sessionApi->orderId($orderId);

        return $this;
    }

    public function currency( $currency = 'BDT' )
    {
        $this->sessionApi->currency($currency);

        return $this;
    }

    public function description( $description = '' )
    {
        $this->sessionApi->description($description);

        return $this;
    }

    public function notifyUrl( $callbackUrl = null )
    {
        $this->sessionApi->notifyUrl($callbackUrl);

        return $this;
    }

    public function storeCard( $pay = true )
    {
        $this->sessionApi->storeCard(true);

        return $this;
    }

    public function cardToken( $token )
    {
        $this->sessionApi->cardToken($token);

        return $this;
    }

    public function cardSecurityCode( $securityCode )
    {
        $this->sessionApi->cardSecurityCode($securityCode);

        return $this;
    }

    public function createSession($customer)
    {
        return $this->sessionApi->create($customer);
    }

    public function updateSession( $sessionKey, $callbackUrl = null )
    {
        return $this->sessionApi->update($sessionKey, $callbackUrl);
    }

    public function retrieveSession($sessionKey)
    {
        return $this->sessionApi->retrieve($sessionKey);
    }

    public function removeSession( $sessionKey )
    {
        return $this->sessionApi->remove($sessionKey);
    }

    public function createToken($sessionKey)
    {
        return $this->tokenizedApi->create($sessionKey);
    }

    public function retrieveToken($customer, $limit, $page)
    {
        return $this->tokenizedApi->retrieve($customer, $limit, $page);
    }

    public function removeToken( $customer, $cardToken )
    {
        return $this->tokenizedApi->remove( $customer, $cardToken );
    }

    public function simplePay( $sessionKey )
    {
        return $this->tokenizedApi->simplePay($sessionKey);
    }

    public function quickPay($customer, $orderId, $amount, $currency, $description, $cardToken, $cardSecurityCode)
    {
        return $this->quickPay($customer, $orderId, $amount, $currency, $description, $cardToken, $cardSecurityCode);
    }

    public function retrieveTransaction($customer, $limit, $page)
    {
        return $this->transactionApi->retrieve($customer, $limit, $page);
    }

    public function retrieveOrderTransaction($customer, $orderId)
    {
        return $this->transactionApi->retrieveOrder($customer, $orderId);
    }

    public function voidTransaction( $customer, $orderId )
    {
        return $this->transactionApi->void($customer, $orderId);
    }

}
