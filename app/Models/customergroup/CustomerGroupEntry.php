<?php

namespace App\Models\customergroup;

use App\Models\customergroup\Traits\CustomerGroupEntryRelationship;
use App\Models\ModelTrait;
use App\Models\customergroup\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Model;

class CustomerGroupEntry extends Model
{
       use BelongsToBranch,ModelTrait,
    	CustomerGroupEntryRelationship {
            // CustomergroupAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

         protected $table = 'customer_group_entries';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [

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
}
