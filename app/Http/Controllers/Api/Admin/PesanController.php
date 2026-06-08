<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    /**
     * GET /api/admin/pesan
     * Menampilkan semua pesan, diurutkan terbaru.
     */
    public function index()
    {
        $pesans = Pesan::orderBy('created_at', 'desc')->get();

        return response()->json(['data' => $pesans]);
    }

    /**
     * POST /api/admin/pesan
     * Simpan pesan baru.
     */
    public function store(Request $request)
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

    /**
     * PUT /api/admin/pesan/{id}
     * Update pesan.
     */
    public function update(Request $request, $id)
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

    /**
     * DELETE /api/admin/pesan/{id}
     * Hapus pesan.
     */
    public function destroy($id)
    {
        Pesan::findOrFail($id)->delete();

        return response()->json(['message' => 'Pesan berhasil dihapus.']);
    }
}
