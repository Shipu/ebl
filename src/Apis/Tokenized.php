<?php


namespace Shipu\Ebl\Apis;


use GuzzleHttp\Psr7\Response;
use Shipu\Ebl\Response\EblResponse;
use Shipu\Ebl\Response\GuzzleResponse;

class Tokenized extends EblApi
{
    public function create( $sessionKey )
    {
        return new EblResponse(new Response(200, [], new GuzzleResponse([
            'redirect_url' => $this->getBaseUrl() . 'card/entry/' . $sessionKey
        ])), []);
    }

    public function retrieve( $customer, $limit, $page )
    {
        return $this->json([
            'customer' => $customer,
            'limit'    => $limit,
            'page'     => $page
        ])->get('token/view.json');
    }

    public function remove( $customer, $cardToken )
    {
        return $this->json([
            'customer'   => $customer,
            'card.token' => $cardToken
        ])->delete('token/remove.json');
    }

    public function simplePay( $sessionKey )
    {
        return $this->get('token/pay'. $sessionKey);
    }

    public function quickPay($customer, $orderId, $amount, $currency, $description, $cardToken, $cardSecurityCode)
    {
        return $this->authorization()->json([
            'customer' => $customer,
            'order.id' => $orderId,
            'order.amount' => $amount,
            'order.currency' => $currency,
            'order.description' => $description,
            'card.token' => $cardToken,
            'card.securityCode' => $cardSecurityCode
        ])->put('token/quick-pay.json');
    }
}
