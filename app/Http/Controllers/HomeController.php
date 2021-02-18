<?php

namespace App\Http\Controllers;

use App\Model\Exam;
use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $exams = Exam::orderBy('exam_date', 'DESC')->where('status', 1)->get();
        return view('home', compact('exams'));
    }
}
