<?php

namespace DoubleThreeDigital\SimpleCommerce\Tags\Concerns;

use DoubleThreeDigital\SimpleCommerce\Facades\Cart;
use DoubleThreeDigital\SimpleCommerce\SimpleCommerce;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

trait CheckoutTags
{
    public function checkout()
    {
        $data = [];
        $cartData = Cart::find(Session::get('simple-commerce-cart'))
            ->entry()
            ->data()
            ->toArray();

        foreach (SimpleCommerce::gateways() as $gateway) {
            $class = new $gateway['class']();

            $data = array_merge($data, $class->prepare($cartData));
        }

        if (isset($data['is_paid'])) {
            $data['is_paid'] = $cartData['is_paid'];
        }

        if ($cartData['is_paid'] === true) {
            $data['receipt_url'] = URL::temporarySignedRoute('statamic.simple-commerce.receipt.show', now()->addHour(), [
                'orderId' => Session::get('simple-commerce-cart'),
            ]);
        }

        return $this->createForm(
            route('statamic.simple-commerce.checkout.store'),
            $data,
            'POST'
        );
    }
}