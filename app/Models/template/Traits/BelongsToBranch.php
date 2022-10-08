<?php
namespace App\Models\template\Traits;

use App\Models\Company\Branch;
use App\Scopes\BranchScope;
use Illuminate\Support\Facades\Auth;

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
