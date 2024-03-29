<?php

namespace App\Models\Company;

use App\Models\Company\Traits\BelongsToBranch;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use BelongsToBranch;

      protected $table = 'goals';

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
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('ins', function ($builder) {
            $builder->where('ins', '=', auth()->user()->ins);
        });
    }

}
