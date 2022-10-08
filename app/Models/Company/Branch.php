<?php

namespace App\Models\Company;

use App\Models\Company\Traits\BranchAttribute;
use App\Models\Company\Traits\BranchRelationship;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    use ModelTrait,
        BranchAttribute,
        BranchRelationship {
            // AccountAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

      protected $table = 'branches';

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

        public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
