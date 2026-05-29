<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string',
            'agree'   => 'nullable',
        ]);

        // Standardize agree checkbox input
        $validated['agree'] = filter_var($request->input('agree'), FILTER_VALIDATE_BOOLEAN);

        $pesan = Pesan::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pesan Anda berhasil terkirim! Terima kasih!',
            'data'    => $pesan
        ], 201);
    }
}
