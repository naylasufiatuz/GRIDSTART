<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GameScore;

class AdminController extends Controller
{
    // ── DASHBOARD ──
    public function dashboard()
    {
        if (auth()->user()->username !== 'admin') {
            return redirect()->route('app');
        }

        $totalUsers      = User::count();
        $totalGameScores = GameScore::count();
        $topScore        = GameScore::max('score') ?? 0;

        return view('admin.dashboard', compact('totalUsers', 'totalGameScores', 'topScore'));
    }

    // ── API USERS ──
public function apiUsers()
{
    $users = User::select('id_user', 'username', 'email', 'created_at')->get();
    return response()->json(['data' => $users]);
}

 public function apiStoreUser(Request $request)
{
    $request->validate([
        'username' => 'required|unique:users,username',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:5',
    ]);

    $user = User::create([
        'username' => $request->username,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'User berhasil dibuat.', 'data' => $user], 201);
}

public function apiUpdateUser(Request $request, $id)
{
    $user = User::where('id_user', $id)->firstOrFail();

    $request->validate([
        'username' => 'sometimes|unique:users,username,' . $id . ',id_user',
        'email'    => 'sometimes|email|unique:users,email,' . $id . ',id_user',
    ]);

    $user->update($request->only(['username', 'email']));

    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($request->password)]);
    }

    return response()->json(['message' => 'User berhasil diupdate.', 'data' => $user]);
}
    public function apiDestroyUser($id)
    {
        $user = User::where('id_user', $id)->firstOrFail();
        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus.']);
    }

    // ── API GAME SCORES ──
    public function apiGameScores()
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

    public function apiStoreGameScore(Request $request)
    {
        $request->validate([
            'id_user'   => 'required|exists:users,id_user',
            'score'     => 'required|integer',
            'best_time' => 'nullable|string',
        ]);

        $score = GameScore::create($request->only(['id_user', 'score', 'best_time']));

        return response()->json(['message' => 'Score berhasil ditambah.', 'data' => $score], 201);
    }

    public function apiUpdateGameScore(Request $request, $id)
    {
        $score = GameScore::findOrFail($id);

        $request->validate([
            'score'     => 'sometimes|integer',
            'best_time' => 'sometimes|string',
        ]);

        $score->update($request->only(['score', 'best_time']));

        return response()->json(['message' => 'Score berhasil diupdate.', 'data' => $score]);
    }

    public function apiDestroyGameScore($id)
    {
        GameScore::findOrFail($id)->delete();
        return response()->json(['message' => 'Score berhasil dihapus.']);
    }
}