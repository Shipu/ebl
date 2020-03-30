<?php


namespace Shipu\Ebl\Apis;


class Transaction extends EblApi
{
    public function retrieve( $customer, $limit, $page )
    {
        return $this->json([
            'customer' => $customer,
            'limit' => $limit,
            'page' => $page
        ])->get('transaction/list.json');
    }

    public function retrieveOrder( $customer, $orderId )
    {
        return $this->json([
            'customer' => $customer,
            'order.id' => $orderId
        ])->get('transaction/view.json');
    }

    public function void( $customer, $orderId )
    {
        return $this->json([
            'customer' => $customer,
            'order.id' => $orderId
        ])->patch('transaction/view.json');
    }
}
