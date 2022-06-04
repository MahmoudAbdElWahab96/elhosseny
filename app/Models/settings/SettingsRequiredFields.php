<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Model;

class SettingsRequiredFields extends Model
{

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'settings_required_fields';

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

}
