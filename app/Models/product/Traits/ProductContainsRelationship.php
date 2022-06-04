<?php

namespace App\Models\product\Traits;
use App\Models\product\Product;
use App\Models\productcategory\Productcategory;
use App\Models\warehouse\Warehouse;
use App\Models\product\ProductContains;

/**
 * Class ProductRelationship
 */
trait ProductContainsRelationship
{
    public function parent() {
        return $this->belongsTo(Product::class,'contain_id');
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
