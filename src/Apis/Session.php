<?php


namespace Shipu\Ebl\Apis;


class Session extends EblApi
{
    protected $data;

    public function amount( $amount )
    {
        $this->data[ 'order.amount' ] = $amount;

        return $this;
    }

    public function orderId( $orderId )
    {
        $this->data[ 'order.id' ] = $orderId;

        return $this;
    }

    public function currency( $currency = 'BDT' )
    {
        $this->data[ 'order.currency' ] = $currency;

        return $this;
    }

    public function description( $description = '' )
    {
        $this->data[ 'order.description ' ] = $description;

        return $this;
    }

    public function notifyUrl( $callbackUrl = null )
    {
        $this->data[ 'notifyUrl' ] = is_null($callbackUrl) ? $this->config[ 'callback_url' ] : $callbackUrl;

        return $this;
    }

    public function storeCard( $pay = true )
    {
        $this->data[ 'pay' ] = $pay;

        return $this;
    }

    public function cardToken( $token )
    {
        $this->data[ 'card.token' ] = $token;

        return $this;
    }

    public function cardSecurityCode( $securityCode )
    {
        $this->data[ 'card.securityCode' ] = $securityCode;

        return $this;
    }

    public function create( $customer )
    {
        return $this->authorization()->json([
            'customer' => $customer
        ])->post('session/create.json');
    }

    public function update( $sessionKey, $callbackUrl = null )
    {
        if ( is_null($callbackUrl) ) {
            $this->notifyUrl();
        }

        return $this->authorization()->json($this->data)->put('session/update/' . $sessionKey . '.json');
    }

    public function retrieve( $sessionKey )
    {
        return $this->authorization()->get('session/view/' . $sessionKey . '.json');
    }

    public function remove( $sessionKey )
    {
        return $this->authorization()->delete('session/remove/' . $sessionKey . '.json');
    }
}
