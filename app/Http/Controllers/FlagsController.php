<?php

namespace App\Http\Controllers;

use App\Flag;
use Illuminate\Http\Request;

class FlagsController extends Controller
{

    /**
     * Get a random collection of flags
     * @param  Request $request
     * @return Collection
     */
    public function index(Request $request)
    {
        $take = $request->get('take', 3);
        $flags = Flag::get()->random($take);
        $flags[rand(0,$take - 1)]->selected = true;
        return ($flags);
    }

    /**
     * Return the result to the player
     * @param  Request $request
     * @return Integer
     */
    public function show(Request $request)
    {
        $correct = 0;

        for ($i=0; $i < count($request->all()); $i++) {
            if($request->get($i)['taken'] === $request->get($i)['correct']) {
                $correct++;
            }
        }


        return $correct;
    }
}
