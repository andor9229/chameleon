<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function normalizeBehavior($behavior)
    {
        foreach ($behavior as $item => $value) {
            if(json_decode($value)) {
                $behavior[$item] = json_decode($value);
            }
        }

        return $behavior;
    }
}
