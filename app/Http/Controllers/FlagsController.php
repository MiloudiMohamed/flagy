<?php

namespace App\Http\Controllers;

use App\Flag;
use Illuminate\Http\Request;

class FlagsController extends Controller
{
    public function index(Request $request)
    {
        $take = $request->get('take', 3);
        $flags = Flag::get()->random($take);
        $flags[rand(0,$take - 1)]->selected = true;
        return ($flags);
    }

    public function show(Request $request)
    {
        $correct = 0;
        for ($i=0; $i < count($request->params); $i++) {
            if($request->params[$i]['taken'] === $request->params[$i]['correct']) {
                $correct++;
            }
        }


        return $correct;
    }
}
