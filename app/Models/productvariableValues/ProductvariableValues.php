<?php

namespace App\Models\productvariableValues;

use App\Models\ModelTrait;
use App\Models\productvariable\Traits\BelongsToBranch;
use App\Models\productvariableValues\Traits\ProductvariableValuesAttribute;
use App\Models\productvariableValues\Traits\ProductvariableValuesRelationship;
use Illuminate\Database\Eloquent\Model;

class ProductvariableValues extends Model
{
    use BelongsToBranch,ModelTrait,
        ProductvariableValuesAttribute,
    	ProductvariableValuesRelationship {
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'product_variable_values';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'value', 'product_variable_id', 'ins'
    ];

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
    protected static function boot()
    {
            parent::boot();
            static::addGlobalScope('ins', function($builder){
            $builder->where('ins', '=', auth()->user()->ins);
    });
    }
}
