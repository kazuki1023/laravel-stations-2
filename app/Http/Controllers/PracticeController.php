<?php

namespace App\Http\Controllers;

class PracticeController extends Controller
{
    public function sample()
    {
        return view('practice');
    }

    public function sample2()
    {
        $test = 'practice2';
        return view('practice2', ['testParam' => $test]);
    }

    public function sample3()
    {
        $testParam = 'test';
        return view('practice3', ['testParam' => $testParam]);
    }

    public function getPractice()
    {
        $practices = \App\Practice::all();
        return view('getPractice', ['practices' => $practices]);
    }
}