<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GameScore;
use App\Models\Pesan;

class AdminController extends Controller
{
    // ── DASHBOARD ──
    public function dashboard()
    {
        // Admin auth sudah ditangani oleh middleware 'admin'

        $totalUsers      = User::count();
        $totalGameScores = GameScore::count();
        $topScore        = GameScore::max('score') ?? 0;
        $totalPesans     = Pesan::count();

        // Recent Activities
        $recentUsers = User::latest()->take(5)->get();
        $recentScores = GameScore::with('user:id_user,username')->latest()->take(5)->get();
        $recentPesans = Pesan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalGameScores', 'topScore', 'totalPesans',
            'recentUsers', 'recentScores', 'recentPesans'
        ));
    }

    // ── API USERS ──
public function apiUsers()
{
    $users = User::with('gameScore')->get()->map(function($user) {
        return [
            'id_user' => $user->id_user,
            'username' => $user->username,
            'email' => $user->email,
            'point' => $user->gameScore->score ?? 0,
            'created_at' => $user->created_at,
        ];
    });
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

    if ($request->has('point')) {
        $user->gameScore()->create(['score' => $request->point]);
    }

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

    if ($request->has('point')) {
        $user->gameScore()->updateOrCreate([], ['score' => $request->point]);
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

    // ── API PESANS ──
    public function apiPesans()
    {
        $pesans = Pesan::orderBy('created_at', 'desc')->get();
        return response()->json(['data' => $pesans]);
    }

    public function apiStorePesan(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string',
            'agree'   => 'boolean',
        ]);

        $pesan = Pesan::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
            'agree'   => (bool)$request->agree,
        ]);

        return response()->json(['message' => 'Pesan berhasil dibuat.', 'data' => $pesan], 201);
    }

    public function apiUpdatePesan(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);

        $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'email'   => 'sometimes|required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'message' => 'sometimes|required|string',
            'agree'   => 'sometimes|boolean',
        ]);

        $pesan->update($request->only(['name', 'email', 'phone', 'message', 'agree']));

        return response()->json(['message' => 'Pesan berhasil diupdate.', 'data' => $pesan]);
    }

    public function apiDestroyPesan($id)
    {
        Pesan::findOrFail($id)->delete();
        return response()->json(['message' => 'Pesan berhasil dihapus.']);
    }
}