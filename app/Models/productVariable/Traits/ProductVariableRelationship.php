<?php

namespace App\Models\productVariable\Traits;

/**
 * Class ProductVariableRelationship
 */
trait ProductVariableRelationship
{
     public function variation() {

        return $this->belongsTo('App\Models\productVariable\ProductVariable','id','sub');
    }

    public function variationValues() {

        return $this->hasMany('App\Models\productVariableValues\ProductVariableValues', 'product_variable_id', 'id');
    }

}
