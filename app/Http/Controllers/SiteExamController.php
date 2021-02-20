<?php

namespace App\Http\Controllers;

use App\Model\Exam;
use App\Model\ExamQuestion;
use App\Model\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteExamController extends Controller
{
    public function exam()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $student = Student::where('user_id', Auth::user()->id)->first();
        $exams = Exam::orderBy('exam_date', 'DESC')->where('status', 1)->where('group_id', $student->group_id)->get();
        return view('frontend.exam.exam', compact('exams'));
    }

    public function join_exam($slug)
    {
        $exam = Exam::where('slug', $slug)->first();
        $questionExam = ExamQuestion::where('exam_id', $exam->id)->get();
        return view('frontend.exam.join_exam', compact('questionExam'));
    }
}
