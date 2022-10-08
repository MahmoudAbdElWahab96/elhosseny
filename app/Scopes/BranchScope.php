<?php
namespace App\Scopes;

use App\Models\Company\Branch;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class BranchScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->hasuser() && Schema::hasColumn($model->getTable(), 'branch_id')) {
            $is_Active = Branch::where('id',branch_id())->where('is_active', 1)->first();

            if (branch_id() && isset($is_Active)) {
                $branch_id = branch_id();

                return $builder->where($model->getTable() . '.branch_id', '=', $branch_id);
            }
        }
    }
}
