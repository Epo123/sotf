<?php

class ShoppingcartController extends BaseController {

    public function showShoppinglist() {
        $usersshoppingcart = Auth::user()->shoppingcart()->first();

        return View::make('shoppinglist')->with('products', ShoppingcartProduct::where('shoppingcart_id', '=', $usersshoppingcart->id)->with('product')->get());
    }

    public function deleteItem($itemcode) {
        $usersshoppingcart = Auth::user()->shoppingcart()->first();

        ShoppingcartProduct::where('shoppingcart_id', '=', $usersshoppingcart->id)->where('product_id', '=', $itemcode)->delete();

        return Redirect::to('shoppinglist');
    }

    public function putInShoppingcart($code) {
        $user = Auth::user();

        if(sizeof(User::has('Shoppingcart')->get()) == 0) {
            $shopcart = new Shoppingcart();
            $shopcart->user()->associate($user);
            $shopcart->save();

            return 'has none';
        }

        $product = Product::where('ean_code', '=', $code)->first();

        $usersshoppingcart = $user->shoppingcart()->first();

        if(ShoppingcartProduct::where('shoppingcart_id', '=', $usersshoppingcart->id)->where('product_id', '=', $product->id)->count() >= 1) {

            $shopcartproduct = ShoppingcartProduct::where('shoppingcart_id', '=', $usersshoppingcart->id)->where('product_id', '=', $product->id)->first();

            $shopcartproduct->quantity = $shopcartproduct->quantity + 1;

            $shopcartproduct->save();
            return Redirect::to('/');
        }

        $shopcartproduct = new ShoppingcartProduct();

        $shopcartproduct->product_id = $product->id;

        $shopcartproduct->quantity = 1;

        $shopcartproduct->shoppingcart_id = $usersshoppingcart->id;

        $shopcartproduct->save();
        return Redirect::to('/');

    }
}