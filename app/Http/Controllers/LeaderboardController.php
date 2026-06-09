<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameScore;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    /**
     * Fungsi untuk menampilkan halaman Leaderboard
     */
    public function index()
    {
        // Ambil SEMUA skor berdasarkan poin tertinggi
        $byPoints = GameScore::with('user')
                        ->orderBy('score', 'desc')
                        ->orderBy('created_at', 'asc')
                        ->get();

        // Ambil SEMUA skor berdasarkan waktu tercepat
        $byTime = GameScore::with('user')
                        ->whereNotNull('best_time')
                        ->orderBy('best_time', 'asc')
                        ->get();

        // Data user yang sedang login
        $userBestPoint = null;
        $userPointRank = null;
        $userBestTime  = null;
        $userTimeRank  = null;

        if (Auth::check()) {
            $uid = Auth::user()->id_user;

            // Skor poin terbaik user
            $userBestPoint = GameScore::where('id_user', $uid)
                                ->orderBy('score', 'desc')
                                ->first();

            if ($userBestPoint) {
                $userPointRank = GameScore::where('score', '>', $userBestPoint->score)->count() + 1;
            }

            // Waktu terbaik user
            $userBestTime = GameScore::where('id_user', $uid)
                                ->whereNotNull('best_time')
                                ->orderBy('best_time', 'asc')
                                ->first();

            if ($userBestTime) {
                $userTimeRank = GameScore::whereNotNull('best_time')
                                ->where('best_time', '<', $userBestTime->best_time)->count() + 1;
            }
        }

        return view('leaderboard', compact(
            'byPoints', 'byTime',
            'userBestPoint', 'userPointRank',
            'userBestTime', 'userTimeRank'
        ));
    }

    /**
     * Fungsi untuk menyimpan skor secara real-time dari game 3D
     */
    public function saveScore(Request $request)
    {
        // 1. Cek apakah user sedang login
        if (!Auth::check()) {
            return response()->json([
                'success' => false, 
                'message' => 'Gagal: User belum login!'
            ], 401);
        }

        try {
            // 2. Simpan ke database
            GameScore::create([
                'id_user'   => Auth::user()->id_user, // Mengambil id_user sesuai databasemu
                'score'     => $request->score,
                'best_time' => $request->best_time
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Skor berhasil masuk klasemen!'
            ], 200);

        } catch (\Exception $e) {
            // 3. Tangkap error jika database bermasalah
            return response()->json([
                'success' => false, 
                'message' => 'Error DB: ' . $e->getMessage()
            ], 500);
        }
    }
}