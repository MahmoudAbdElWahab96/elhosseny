<?php

namespace App\Models\product\Traits;
use App\Models\product\ProductVariation;
use App\Models\productcategory\Productcategory;
use App\Models\warehouse\Warehouse;
use App\Models\product\ProductContains;

/**
 * Class ProductRelationship
 */
trait ProductRelationship
{

    public function standard()
    {
        return $this->hasOne(ProductVariation::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

        public function variations_b()
    {
        return $this->belongsTo(ProductVariation::class);
    }

     public function category()
    {
        return $this->hasOne(Productcategory::class,'id','productcategory_id');
    }

         public function subcategory()
    {
        return $this->hasOne(Productcategory::class,'id','sub_cat_id');
    }

     public function record()
    {
        return $this->hasMany(ProductVariation::class);
    }
         public function record_one()
    {
        return $this->hasOne(ProductVariation::class);
    }

    public function contains()
    {
        return $this->hasMany(ProductContains::class);
    }
}
