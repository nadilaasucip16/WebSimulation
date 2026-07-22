<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentScore;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentSetting;

class AssessmentController extends Controller
{
    public function showPretest()
    {
        return view('pretest', [
            'questions' => AssessmentQuestion::where('type', 'pretest')->orderBy('number')->get(),
            'timeLimit' => AssessmentSetting::timeLimitFor('pretest'),
        ]);
    }

    public function showPosttest()
    {
        return view('posttest', [
            'questions' => AssessmentQuestion::where('type', 'posttest')->orderBy('number')->get(),
            'timeLimit' => AssessmentSetting::timeLimitFor('posttest'),
        ]);
    }

    public function submitPretest(Request $request)
    {
        $questions = AssessmentQuestion::where('type', 'pretest')->orderBy('number')->get();
        $total     = $questions->count();
        $correct   = 0;

        foreach ($questions as $q) {
            if ($request->input("q{$q->number}") === $q->answer) {
                $correct++;
            }
        }

        $score = $total > 0 ? (int) round($correct / $total * 100) : 0;

        StudentScore::updateOrCreate(
            ['user_id' => Auth::id()],
            ['pretest' => $score]
        );

        return redirect()->route('lesson')->with('pretest_score', $score);
    }

    public function submitPosttest(Request $request)
    {
        $questions = AssessmentQuestion::where('type', 'posttest')->orderBy('number')->get();
        $total     = $questions->count();
        $correct   = 0;

        foreach ($questions as $q) {
            if ($request->input("q{$q->number}") === $q->answer) {
                $correct++;
            }
        }

        $score = $total > 0 ? (int) round($correct / $total * 100) : 0;

        StudentScore::updateOrCreate(
            ['user_id' => Auth::id()],
            ['posttest' => $score]
        );

        return redirect()->route('grade')->with('posttest_score', $score);
    }
}
