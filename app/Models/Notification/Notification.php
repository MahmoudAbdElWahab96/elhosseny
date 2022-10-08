<?php

namespace App\Models\Notification;

use App\Models\BaseModel;
use App\Models\Notification\Traits\BelongsToBranch;

class Notification extends BaseModel
{
    use BelongsToBranch;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct()
    {
        $this->table = config('access.notifications_table');
    }
}
