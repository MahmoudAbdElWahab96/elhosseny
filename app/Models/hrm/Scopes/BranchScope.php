<?php
namespace App\Models\hrm\Scopes;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class BranchScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->hasuser() && Schema::hasColumn($model->getTable(), 'branch_id')) {
            if ($branch_id = branch_id()) {
                return $builder->where($model->getTable() . '.branch_id', '=', $branch_id);
            }
        }
    }
}
