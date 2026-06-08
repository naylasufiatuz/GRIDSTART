<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GameScore;
use App\Models\Pesan;

class DashboardController extends Controller
{
    /**
     * GET /api/admin/dashboard/stats
     * Mengembalikan statistik ringkasan untuk overview dashboard.
     */
    public function stats()
    {
        return response()->json([
            'data' => [
                'totalUsers'      => User::count(),
                'totalGameScores' => GameScore::count(),
                'topScore'        => GameScore::max('score') ?? 0,
                'totalPesans'     => Pesan::count(),
            ],
        ]);
    }

    /**
     * GET /api/admin/dashboard/activity
     * Mengembalikan aktivitas terbaru (users, scores, pesan).
     */
    public function activity()
    {
        $recentUsers = User::latest()->take(5)->get()->map(fn($u) => [
            'username'   => $u->username,
            'created_at' => $u->created_at->diffForHumans(),
        ]);

        $recentScores = GameScore::with('user:id_user,username')
            ->latest()->take(5)->get()->map(fn($s) => [
                'username'   => $s->user->username ?? 'Unknown',
                'score'      => $s->score,
                'created_at' => $s->created_at->diffForHumans(),
            ]);

        $recentPesans = Pesan::latest()->take(5)->get()->map(fn($p) => [
            'name'       => $p->name,
            'created_at' => $p->created_at->diffForHumans(),
        ]);

        return response()->json([
            'data' => [
                'recentUsers'  => $recentUsers,
                'recentScores' => $recentScores,
                'recentPesans' => $recentPesans,
            ],
        ]);
    }
}
