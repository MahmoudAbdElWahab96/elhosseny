<?php

namespace App\Models\screen;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\screen\Traits\ScreenAttribute;
use App\Models\screen\Traits\ScreenRelationship;
use App\Models\costCenter\CostCenter;

class Screen extends Model
{
    use ModelTrait,
        ScreenAttribute,
        ScreenRelationship {
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
    protected $table = 'screens';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'name_ar', 'name_en', 'type', 'code', 'active'
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
//    protected static function boot()
//    {
//            parent::boot();
//            static::addGlobalScope('ins', function($builder){
//            $builder->where('ins', '=', auth()->user()->ins);
//    });
//    }
//    public function GetTypeAttribute()
//    {
//        if ($this->attributes['type'] == 1) {
//            return trans('screens.types.1');
//        } elseif ($this->attributes['type'] == 2) {
//            return trans('screens.types.2');
//
//        } elseif ($this->attributes['type'] == 3) {
//            return trans('screens.types.3');
//
//        } else {
//            return trans('screens.types.0');
//
//        }
//    }
    public function LocaleName()
    {
        $lang = app()->getLocale();
        if ($lang == 'ar') {
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

    public function costCenters()
    {
        return $this->hasMany(CostCenter::class);
    }
}
