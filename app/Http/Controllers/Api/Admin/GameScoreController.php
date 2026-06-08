<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameScore;

class GameScoreController extends Controller
{
    /**
     * GET /api/admin/game-scores
     * Menampilkan semua game scores dengan username.
     */
    public function index()
    {
        $scores = GameScore::with('user:id_user,username')
            ->orderByDesc('score')
            ->get()
            ->map(fn($s) => [
                'id'         => $s->id,
                'username'   => $s->user->username ?? '-',
                'score'      => $s->score,
                'best_time'  => $s->best_time,
                'created_at' => $s->created_at,
            ]);

        return response()->json(['data' => $scores]);
    }

    /**
     * POST /api/admin/game-scores
     * Tambah game score baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_user'   => 'required|exists:users,id_user',
            'score'     => 'required|integer',
            'best_time' => 'nullable|string',
        ]);

        $score = GameScore::create($request->only(['id_user', 'score', 'best_time']));

        return response()->json(['message' => 'Score berhasil ditambah.', 'data' => $score], 201);
    }

    /**
     * PUT /api/admin/game-scores/{id}
     * Update game score.
     */
    public function update(Request $request, $id)
    {
        $score = GameScore::findOrFail($id);

        $request->validate([
            'score'     => 'sometimes|integer',
            'best_time' => 'sometimes|string',
        ]);

        $score->update($request->only(['score', 'best_time']));

        return response()->json(['message' => 'Score berhasil diupdate.', 'data' => $score]);
    }

    /**
     * DELETE /api/admin/game-scores/{id}
     * Hapus game score.
     */
    public function destroy($id)
    {
        GameScore::findOrFail($id)->delete();

        return response()->json(['message' => 'Score berhasil dihapus.']);
    }
}
