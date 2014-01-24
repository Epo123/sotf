<?php

class ShoppingcartProduct extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shoppingcarts_products';

    public $timestamps = false;

    public function shoppingcart() {
        return $this->belongsTo('Shoppingcart');
    }

    public function product() {
        return $this->belongsTo('Product');
    }

}