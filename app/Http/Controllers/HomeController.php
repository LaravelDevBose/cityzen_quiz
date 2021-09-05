<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuizUserResource;
use App\Models\QuizUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $quizResults = QuizUser::where('status', '!=', 0)->latest()->paginate(15);
        $quizResults = QuizUserResource::collection($quizResults);
        return Inertia::render('Dashboard', compact('quizResults'));
    }

    public function quiz_results()
    {
        $quizResults = QuizUser::where('status', '!=', 0)->latest()->paginate(15);
        $quizResults = QuizUserResource::collection($quizResults);
        return Inertia::render('QuizResult', compact('quizResults'));
    }
}
