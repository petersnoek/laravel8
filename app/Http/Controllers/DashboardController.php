<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index() {
        $total_groups = Group::all()->count();
        $total_students = Student::all()->count();

        return View('dashboard', [
            'total_groups'=>$total_groups,
            'total_students'=>$total_students
        ]);
    }

    public function groups_students(Request $request) {
        $groups = Group::with('students')->get();
        return View('dashboards.groups_students', compact('groups'));
    }
}
