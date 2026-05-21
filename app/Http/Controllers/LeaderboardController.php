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
        // 1. Ambil Top 10 berdasarkan Skor Tertinggi
        $byPoints = GameScore::with('user')
                        ->orderBy('score', 'desc')
                        ->orderBy('created_at', 'asc') // Jika skor sama, yang duluan main di atas
                        ->take(10)
                        ->get();

        // 2. Ambil Top 10 berdasarkan Waktu Tercepat (Fastest Lap)
        $byTime = GameScore::with('user')
                        ->whereNotNull('best_time')
                        ->orderBy('best_time', 'asc') // Mengurutkan string waktu (MM:SS.ms)
                        ->take(10)
                        ->get();

        // Lempar variabel ke view leaderboard
        return view('leaderboard', compact('byPoints', 'byTime'));
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
                'user_id'   => Auth::user()->id_user, // Mengambil id_user sesuai databasemu
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