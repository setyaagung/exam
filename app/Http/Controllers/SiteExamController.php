<?php

namespace App\Http\Controllers;

use App\Model\Exam;
use App\Model\ExamQuestion;
use App\Model\Result;
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
        return view('frontend.exam.join_exam', compact('questionExam', 'exam'));
    }

    public function submit_exam(Request $request)
    {
        $true_answer = 0;
        $false_answer = 0;
        $data = $request->all();
        $result = array();
        for ($i = 1; $i <= $request->index; $i++) {
            if (isset($data['question' . $i])) {
                $question = ExamQuestion::where('id', $data['question' . $i])->get()->first();
                if ($question->answer == $data['answer' . $i]) {
                    $result[$data['question' . $i]] = 'true';
                    $true_answer++;
                } else {
                    $result[$data['question' . $i]] = 'false';
                    $false_answer++;
                }
            }
        }
        $data['user_id'] = Auth::user()->id;
        $data['true_answer'] = $true_answer;
        $data['false_answer'] = $false_answer;
        $data['result_json'] = json_encode($result);

        Result::create($data);
        //return response()->json($final);
        return redirect()->route('exam')->with('success', 'Anda telah menyelesaikan ujian');
    }

    public function show_result($slug, $id)
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        $exam = Exam::where('slug', $slug)->first();
        $question = ExamQuestion::where('exam_id', $exam->id)->get()->first();
        $show_result = Result::where('id', $id)->where('exam_id', $exam->id)->get()->first();
        return view('frontend.exam.show_result', compact('show_result', 'exam', 'student'));
    }
}
