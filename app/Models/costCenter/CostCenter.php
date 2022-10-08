<?php

namespace App\Models\costCenter;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\costCenter\Traits\CostCenterAttribute;
use App\Models\costCenter\Traits\CostCenterRelationship;
use App\Models\screen\Screen;
use App\Models\account\Account;
use App\Models\costCenter\Traits\BelongsToBranch;

class CostCenter extends Model
{
    use BelongsToBranch,ModelTrait,
        CostCenterAttribute,
        CostCenterRelationship {
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
    protected $table = 'cost_centers';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [
        'name_ar', 'name_en', 'code', 'active', 'screen_id','cost_balance'
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

    public function screens()
    {
        return $this->hasOne(Screen::class,'id');

    }
}
