<?php

namespace App\Http\Controllers;

use App\Model\Course;
use App\Model\Exam;
use App\Model\ExamQuestion;
use App\Model\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $exams = Exam::orderBy('exam_date', 'DESC')->get();
        return view('backend.exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::orderBy('name', 'ASC')->get();
        $groups = Group::orderBy('name', 'ASC')->get();
        return view('backend.exam.create', compact('courses', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:exams',
            'course_id' => 'required',
            'group_id' => 'required',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->input('title'));
        $data['status'] = 1;
        Exam::create($data);
        return redirect()->route('exam.index')->with('create', 'Data ujian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $courses = Course::orderBy('name', 'ASC')->get();
        $groups = Group::orderBy('name', 'ASC')->get();
        return view('backend.exam.edit', compact('exam', 'courses', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255|unique:exams,title,' . $id,
            'course_id' => 'required',
            'group_id' => 'required',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->input('title'));
        $exam->update($data);
        return redirect()->route('exam.index')->with('update', 'Data ujian berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_status($id)
    {
        $exam = Exam::findOrFail($id);
        if ($exam->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $exam->status = $status;
        $exam->update();
    }

    public function question($slug)
    {
        $exam = Exam::where('slug', $slug)->first();
        $questions = ExamQuestion::where('exam_id', $exam->id)->get();
        return view('backend.exam.question', compact('exam', 'questions'));
    }

    public function create_question($slug)
    {
        $exam = Exam::where('slug', $slug)->first();
        return view('backend.exam.create_question', compact('exam'));
    }

    public function store_question(Request $request)
    {
        $data = $request->all();
        $data['option'] = json_encode([
            'option1' => $request->input('option1'),
            'option2' => $request->input('option2'),
            'option3' => $request->input('option3'),
            'option4' => $request->input('option4'),
        ]);
        //dd($data);
        ExamQuestion::create($data);
        return redirect()->back()->with('create', 'Pertanyaan baru berhasil dibuat. Silahkan tambah pertanyaan lagi');
    }

    public function edit_question($slug, $id)
    {
        $exam = Exam::where('slug', $slug)->first();
        $question = ExamQuestion::findOrFail($id);
        $options = json_decode($question->option);
        return view('backend.exam.edit_question', compact('exam', 'question', 'options'));
    }

    public function update_question(Request $request, $slug, $id)
    {
        $question = ExamQuestion::findOrFail($id);
        $exam = Exam::where('slug', $slug)->first();
        $data = $request->all();
        $data['option'] = json_encode([
            'option1' => $request->input('option1'),
            'option2' => $request->input('option2'),
            'option3' => $request->input('option3'),
            'option4' => $request->input('option4'),
        ]);
        //dd($data);
        $question->update($data);
        return redirect()->back()->with('update', 'Pertanyaan berhasil diperbarui');
    }

    public function destroy_question($slug, $id)
    {
        $exam = Exam::where('slug', $slug)->first();
        $question = ExamQuestion::findOrFail($id);
        $question->delete();
        return redirect()->back()->with('delete', 'Pertanyaan berhasil dihapus');
    }
}
