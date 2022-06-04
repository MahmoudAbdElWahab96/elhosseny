<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\screen\Screen;

class Controller extends BaseController
{
    public function __construct()
    {


    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
