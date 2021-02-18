<?php

namespace App\Http\Controllers;

use App\Model\Exam;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $exams = Exam::count();
        $users = User::count();
        return view('backend.dashboard', compact('exams', 'users'));
    }
}
