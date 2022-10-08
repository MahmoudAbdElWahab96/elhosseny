<?php

namespace App\Models\Company;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Traits\UserGatewayRelationship;
use App\Models\Company\Traits\BelongsToBranch;

class UserGateway extends Model
{
       use BelongsToBranch,ModelTrait, UserGatewayRelationship {
        // InvoiceAttribute::getEditButtonAttribute insteadof ModelTrait;
    }

}
