<?php

class Shoppingcart extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shoppingcarts';

    public function shoppingcartProducts() {
        return $this->hasMany('ShoppingcartProduct');
    }

}