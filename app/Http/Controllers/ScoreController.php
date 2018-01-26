<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        return Score::with('user')->orderBy('points', 'desc')->get();
    }

    public function store(Request $request)
    {

        $points = ($request->correct * 10) + $this->addBonus($request->options, $request->correct);

        if (!auth()->check()) {
            $this->saveIfAGuest($points);
            return response()->json(200);
        }

        if (auth()->user()->score()->exists()) {
            $this->saveIfAleardyAPlayer($points);
            return response()->json(200);
        }

        $this->saveIfFirstTimePlaying($points);
        return response()->json(200);


    }

    protected function saveIfAGuest($points)
    {
        session()->put('points', $points);
    }

    protected function saveIfAleardyAPlayer($points)
    {
        $userScore = Score::where('user_id', auth()->id())->first();
        $userScore->points = $userScore->points + $points;
        $userScore->played_time = $userScore->played_time + 1;
        $userScore->save();
    }

    protected function saveIfFirstTimePlaying($points)
    {
         auth()->user()->score()->create([
            'points' => $points,
            'played_time' => 1
        ]);
    }

    protected function addBonus($options, $correct)
    {
        if ($options['flagsNumber'] == $correct) {
            return ($correct / 2) * 10;
        }

        return 0;
    }
}
