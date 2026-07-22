<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reflection;
use App\Models\LearningProgress;

class Fase5Controller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jawaban'  => 'required|in:A,B,C,D,E',
            'refleksi' => 'required|string|max:2000',
        ]);

        Reflection::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'jawaban'  => $request->jawaban,
                'refleksi' => $request->refleksi,
            ]
        );

        $progress = LearningProgress::firstOrCreate(['user_id' => Auth::id()]);
        $progress->fase5 = true;
        $progress->save();

        return redirect()->route('grade')
            ->with('success', 'Refleksi berhasil disimpan!');
    }
}
