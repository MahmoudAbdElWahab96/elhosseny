<?php
namespace App\Models\productvariableValues\Traits;

use App\Models\Company\Branch;
use App\Scopes\BranchScope;

trait BelongsToBranch
{
    public static $branchIdColumn = 'branch_id';

    public function branch()
    {
        return $this->belongsTo(Branch::class, BelongsToBranch::$branchIdColumn);
    }

    public static function bootBelongsToBranch()
    {
        static::addGlobalScope(new BranchScope);
        static::creating(function ($model) {
            if (!$model->getAttribute(BelongsToBranch::$branchIdColumn) && ! $model->relationLoaded('branch')) {
                $model->setAttribute(BelongsToBranch::$branchIdColumn,branch_id());
            }
        });
    }
}
