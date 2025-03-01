---
title: 'Cart'
---

## Cart Information

`{{ sc:cart }}` returns an augmented version of the Cart entry.

```antlers
{{ sc:cart }}
  	<h2>Order {{ title }}</h2>
  	<p>Your order has been successful and will be fulfilled shortly.</p>
{{ /sc:cart }}
```

## Cart Items

This is probably the most common use case for the `sc:cart` tag, fetching items from the cart.

The variables available in this tag are also augmented. Allowing you to get data on the attached product, like this: `{{ product:short_description }}`.

```antlers
{{ sc:cart:items }}
	{{ product:title }} - {{ quantity }} - {{ total }}
{{ /sc:cart:items }}
```

To get a count of the items in the customers' cart, use `{{ sc:cart:count }}`.

To get the total quantity of products in the customers' cart, use `{{ sc:cart:quantityTotal }}`.

## Check if customer has a cart

This tag allows you to check if the current customer has a cart attached to them. It'll return a boolean, meaning you can use it in one of Antlers' if statements.

```antlers
{{ if {sc:cart:has} === false }}
  	<p>There's nothing in your cart. <a href="#">Start shopping</a>.</p>
{{ /if }}
```

## Totals

There's tags for each of the different totals in a cart.

* `{{ sc:cart:total }}` - Returns the overall/grand total of the cart
* `{{ sc:cart:grand_total }}` - Does the same thing as `sc:cart:total`
* `{{ sc:cart:items_total }}` - Returns the total of all cart items.
* `{{ sc:cart:shipping_total }}` - Returns the shipping total of the cart.
* `{{ sc:cart:tax_total }}` - Returns the tax total of the cart.
* `{{ sc:cart:coupon_total }}` - Returns the total amount saved from coupons.

If you need the 'raw' value for any of these totals, meaning the integer, rather than the formatted currency amount, you can do this: `{{ sc:cart:raw_grand_total }}`

## Add Item to Cart

This tag allows you to add a product/variant to your cart. It's a [form tag](/tags#form-tags) so you need to provide a couple of parameters (form fields) when submitting:

* `product` - The ID of the product you want to add to the cart.
* `variant` - If applicable, the key of the variant you wish to add to the cart. Bear in mind, you will also need to provide the `product` with this.
* `quantity` - The quantity of the cart item you're adding.

```antlers
{{ sc:cart:addItem }}
  <input type="hidden" name="product" value="{{ id }}">
  <input type="number" name="quantity" value="2">
{{ /sc:cart:addItem }}
```

## Update Cart Item

With this tag, you can update a specific item in your cart. It's a [form tag](/tags#form-tags).

The tag itself requires an `item` parameter which should be the ID of the specfic cart item you wish to update. You may then provide the parameters you wish to update on the item as input fields, like the below example:

```antlers
{{ sc:cart:updateItem :item="id" }}
  <input type="number" name="quantity" value="2">
{{ /sc:cart:updateItem }}
```

## Remove Cart Item

This tag allows you to remove an item from the cart. It's a [form tag](/tags#form-tags) and the only required parameter is on the tag itself: the `item` parameter should be the ID or the specific cart item you wish to remove from the cart.

```antlers
{{ sc:cart:removeItem :item="id" }}
  <button type="submit">Remove item from cart</button>
{{ /sc:cart:removeItem }}
```

## Update Cart

This tag can be used to update any field values in the cart, kinda like [Workshop](https://statamic.com/addons/statamic/workshop), but just for carts. You can send whatever parameters you want, just ensure they are added to the entry blueprint for your orders.

```antlers
{{ sc:cart:update }}
  <input type="text" name="delivery_note">
{{ /sc:cart:update }}
```

> **🔥 Hot Tip:** If you want to also update the customer at the same time, something like the below should work. Remember the `email`, it's required.

```antlers
<input type="text" name="customer[name]">
<input type="email" name="customer[email]">
```

## Empty Cart

If you want to empty all the items from the cart and start from scratch. You can use the `{{ sc:cart:empty }}` tag. It doesn't accept any parameters.

```antlers
{{ sc:cart:empty }}
  <button>I messed up.. there's too much in my cart. I need a fresh start.</button>
{{ /sc:cart:empty }}
```

## Checking if a product exists in the customer's cart

Sometimes you'll want to know if a certain product (or product variant) exists in a customer's cart. Well, it's a good thing it's easy peasy to check.

**Standard Products**

```antlers
{{ if {sc:cart:alreadyExists :product="id"} }}
  This product is already in your cart.
{{ /if }}
```

**Variant Products**

```antlers
{{ if {sc:cart:alreadyExists :product="id" variant="Red_Small"} }}
  This product is already in your cart.
{{ /if }}
```
