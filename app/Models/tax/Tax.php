<?php

namespace App\Models\tax;

use App\Models\additional\Additional;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\tax\Traits\TaxAttribute;
use App\Models\tax\Traits\TaxRelationship;

class Tax extends Model
{
    use ModelTrait,
        TaxAttribute,
    	TaxRelationship {
            // BankAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'taxes';

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
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function additional()
    {
        return $this->hasMany(Additional::class, 'tax_id','id');
    }

//    protected static function boot()
//    {
//            parent::boot();
//            static::addGlobalScope('ins', function($builder){
//            $builder->where('ins', '=', auth()->user()->ins);
//    });
//    }
}
