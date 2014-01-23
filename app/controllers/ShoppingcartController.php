<?php

class ShoppingcartController extends BaseController {

    public function putInShoppingcart($code) {
        $user = Auth::user();

        if(sizeof(User::has('Shoppingcart')->get()) == 0) {
            $shopcart = new Shoppingcart();
            $shopcart->user()->associate($user);
            $shopcart->save();

            return 'has none';
        }

        $usersshoppingcart = $user->shoppingcart()->get();

        dd($usersshoppingcart);

        $shopcartproduct = new ShoppingcartProduct();

        $shopcartproduct->shoppingcart()->associate($shopcartproduct);

        $product = Product::where('ean_code', '=', $code)->first();

        $shopcartproduct->product_id = $product->id;

        $shopcartproduct->quantity = 1;

        $shopcartproduct->shoppingcart_id = $product->id;

        $shopcartproduct->save();

        return $user->shoppingcart();

    }
}