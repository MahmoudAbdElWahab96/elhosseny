<?php

namespace App\Models\System;

use App\Models\BaseModel;
use App\Models\System\Traits\BelongsToBranch;

/**
 * Class Session
 * package App.
 */
class Session extends BaseModel
{
    use BelongsToBranch;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessions';

    /**
     * @var array
     */
    protected $guarded = ['*'];
}
