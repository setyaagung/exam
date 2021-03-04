<?php

namespace App\Http\Controllers;

use App\Model\Group;
use App\Model\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', Auth::user()->id)->get()->first();
        $user = User::where('id', $student->user_id)->get()->first();
        $groups = Group::orderBy('name', 'ASC')->get();
        return view('frontend.biodata.index', compact('user', 'groups', 'student'));
    }

    public function update(Request $request)
    {
        $student = Student::where('user_id', Auth::user()->id)->get()->first();
        $user = User::where('id', $student->user_id)->get()->first();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'group_id' => 'required'
        ]);
        $data = $request->all();
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $student->update([
            'name' => $data['name'],
            'group_id' => $data['group_id']
        ]);
        return redirect()->route('biodata')->with('update', 'Biodata anda berhasil diperbarui');
    }
}
