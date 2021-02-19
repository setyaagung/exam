<?php

namespace App\Http\Controllers;

use App\Model\Exam;
use App\Model\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $student = Student::where('user_id', Auth::user()->id)->first();
        $exams = Exam::orderBy('exam_date', 'DESC')->where('status', 1)->where('group_id', $student->group_id)->get();
        return view('home', compact('exams'));
    }

    public function join_exam()
    {
        return view('frontend.exam.join_exam');
    }
}
