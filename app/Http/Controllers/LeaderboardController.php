<?php

namespace App\Http\Controllers;

use App\Models\GameScore;

class LeaderboardController extends Controller
{
    public function index()
    {
        $byPoints = GameScore::with('user')
            ->orderBy('score', 'desc')
            ->take(10)
            ->get();

        $byTime = GameScore::with('user')
            ->whereNotNull('best_time')
            ->orderBy('best_time', 'asc')
            ->take(10)
            ->get();

        return view('leaderboard', compact('byPoints', 'byTime'));
    }
}