<?php

namespace App\Http\Controllers;

use App\Model\Course;
use App\Model\Group;
use App\Model\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('backend.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $teacherGroupIds = [];
        $teacherCourseIds = [];
        $teacher = Teacher::findOrFail($id);
        $groups = Group::orderBy('name', 'ASC')->get();
        $courses = Course::orderBy('name', 'ASC')->get();
        foreach ($teacher->groups as $teacherGroup) {
            $teacherGroupIds[] = $teacherGroup->id;
        }
        foreach ($teacher->courses as $teacherCourse) {
            $teacherCourseIds[] = $teacherCourse->id;
        }
        return view('backend.teacher.edit', compact('teacher', 'groups', 'courses', 'teacherGroupIds', 'teacherCourseIds'));
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
        $teacher = Teacher::findOrFail($id);
        $data = $request->all();

        DB::transaction(function () use ($teacher, $data) {
            $groupIds = !empty($data['group_id']) ? $data['group_id'] : [];
            $courseIds = !empty($data['course_id']) ? $data['course_id'] : [];

            //$teacher->update($data);
            $teacher->groups()->attach($groupIds);
            $teacher->courses()->attach($courseIds);
            return true;
        });
        return redirect()->route('teacher.index')->with('update', 'Data guru berhasil diperbarui');
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
}
