<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * GET /api/admin/users
     * Menampilkan semua users beserta poin dari game score.
     */
    public function index()
    {
        $users = User::with('gameScore')->get()->map(function ($user) {
            return [
                'id_user'    => $user->id_user,
                'username'   => $user->username,
                'email'      => $user->email,
                'point'      => $user->gameScore->score ?? 0,
                'created_at' => $user->created_at,
            ];
        });

        return response()->json(['data' => $users]);
    }

    /**
     * POST /api/admin/users
     * Membuat user baru.
     */
    public function store(Request $request)
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

    /**
     * PUT /api/admin/users/{id}
     * Update user yang sudah ada.
     */
    public function update(Request $request, $id)
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

    /**
     * DELETE /api/admin/users/{id}
     * Hapus user.
     */
    public function destroy($id)
    {
        $user = User::where('id_user', $id)->firstOrFail();
        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus.']);
    }
}
