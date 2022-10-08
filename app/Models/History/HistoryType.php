<?php

namespace App\Models\History;

use App\Models\BaseModel;
use App\Models\History\Traits\Relationship\BelongsToBranch;

/**
 * Class HistoryType
 * package App.
 */
class HistoryType extends BaseModel
{
    use BelongsToBranch;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
