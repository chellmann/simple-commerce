<?php

return [

    'actions' => [
        'mark_as_paid' => 'Mark As Paid',
        'refund' => 'Refund',
    ],

    'fieldtypes' => [
        'money' => [
            'title' => 'Money',

            'config_fields' => [
                'read_only' => 'Should this field be read only?',
            ],
        ],

        'product_variants' => [
            'title' => 'Product Variants',

            'config_fields' => [
                'option_fields' => [
                    'display'      => 'Option Fields',
                    'instructions' => 'Configure fields that will be shown when an option is created.',
                ],
            ],
        ],
    ],

    'gateways' => [
        'stripe' => [
            'no_payment_intent_provided' => 'No payment intent has been provided, a refund is not possible without a payment intent.',
            'stripe_secret_missing'      => 'Your Stripe secret couldn\'t be found. Make sure to add it to your gateway configuration.',
        ],
    ],

    'shipping_methods' => [
        'standard_post' => [
            'name'        => 'Standard Post',
            'description' => 'Posted through the national post service. Usually delivered within 1-2 working days.',
        ],
    ],

    'validation' => [
        'entry_exists' => 'The entry :value does not exist.',
        'country_exists' => 'The selected country is not recognised.',
        'is_a_gateway' => ':value is not a gateway',
        'valid_coupon' => 'Sorry, this coupon is not valid for your order.',
    ],

    'customer_title'            => ':name <:email>',
    'product_has_no_variants'   => 'No variants.',
    'product_variants_singular' => 'variant',
    'product_variants_plural'   => 'variants',

    'cart_updated'             => 'Cart Updated',
    'cart_deleted'             => 'Cart Deleted',
    'cart_item_added'          => 'Added to Cart',
    'cart_item_updated'        => 'Cart Item Updated',
    'cart_item_deleted'        => 'Item Removed from Cart',
    'checkout_complete'        => 'Checkout Complete!',
    'customer_updated'         => 'Customer Updated',
    'coupon_added_to_cart'     => 'Coupon added to cart',
    'coupon_removed_from_cart' => 'Coupon removed from cart',
    'invalid_coupon'           => 'Coupon is not valid.',

];
