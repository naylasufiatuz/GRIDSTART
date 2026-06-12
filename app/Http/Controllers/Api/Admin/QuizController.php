<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of the quizzes.
     */
    public function index()
    {
        $quizzes = quiz::orderBy('id', 'asc')->get();
        return response()->json(['data' => $quizzes]);
    }

    /**
     * Store a newly created quiz in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quiz_type'      => 'required|in:obstacle,pitstop',
            'obstacle_type'  => 'nullable|string|max:50',
            'question'       => 'required|string',
            'option_a'       => 'required|string|max:255',
            'option_b'       => 'required|string|max:255',
            'option_c'       => 'required|string|max:255',
            'option_d'       => 'nullable|string|max:255',
            'correct_answer' => 'required|string|size:1',
            'points'         => 'required|integer',
        ]);

        $quiz = quiz::create($request->all());

        return response()->json(['message' => 'Kuis berhasil dibuat.', 'data' => $quiz], 201);
    }

    /**
     * Display the specified quiz.
     */
    public function show($id)
    {
        $quiz = quiz::findOrFail($id);
        return response()->json(['data' => $quiz]);
    }

    /**
     * Update the specified quiz in storage.
     */
    public function update(Request $request, $id)
    {
        $quiz = quiz::findOrFail($id);

        $request->validate([
            'quiz_type'      => 'sometimes|required|in:obstacle,pitstop',
            'obstacle_type'  => 'nullable|string|max:50',
            'question'       => 'sometimes|required|string',
            'option_a'       => 'sometimes|required|string|max:255',
            'option_b'       => 'sometimes|required|string|max:255',
            'option_c'       => 'sometimes|required|string|max:255',
            'option_d'       => 'nullable|string|max:255',
            'correct_answer' => 'sometimes|required|string|size:1',
            'points'         => 'sometimes|required|integer',
        ]);

        $quiz->update($request->all());

        return response()->json(['message' => 'Kuis berhasil diupdate.', 'data' => $quiz]);
    }

    /**
     * Remove the specified quiz from storage.
     */
    public function destroy($id)
    {
        $quiz = quiz::findOrFail($id);
        $quiz->delete();

        return response()->json(['message' => 'Kuis berhasil dihapus.']);
    }
}
