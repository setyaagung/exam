<?php

namespace App\Http\Controllers;

use App\Model\Course;
use App\Model\Exam;
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
}
