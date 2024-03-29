<?php

namespace App\Models\product;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\product\Traits\ProductAttribute;
use App\Models\product\Traits\ProductRelationship;
use App\Models\product\Traits\ProductContainsRelationship;
use App\Models\product\Traits\BelongsToBranch;

class ProductContains extends Model
{
    use BelongsToBranch,ModelTrait,
    ProductContainsRelationship {
        // ProductAttribute::getEditButtonAttribute insteadof ModelTrait;
    }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'product_contains';

    /**
     * Mass Assignable fields of model
     * @var array
     */

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
