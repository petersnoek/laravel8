<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;

class StudentController extends Controller
{
    private $validation_rules = [
        'student_code' => 'required|unique:students|min:8|max:8|between:0,99999999',
        'voornaam' => 'required|max:255',
        'tussenvoegsel' => 'nullable',
        'achternaam' => 'required|max:255',
        'avatar' => 'nullable|sometimes|image|mimes:jpeg,png',
        'schedule_code' => 'nullable|sometimes|min:6'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index')->with('students', $students);
    }

    public function import_start() {
        return view('students.import');
    }

    public function import_process(Request $request) {

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return View('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate($this->validation_rules);

        $newStudent = new Student();
        $newStudent->student_code = $request->student_code;
        $newStudent->voornaam = $request->voornaam;
        $newStudent->tussenvoegsel = $request->tussenvoegsel;
        $newStudent->achternaam = $request->achternaam;
        $newStudent->created_by = Auth::user()->id;
        $newStudent->save();

        if ($request->hasFile('avatar')) {
            // check if file is present and valid
            if ($request->file('avatar')->isValid()) {
                // rename original file to the provided student_code (
                $fname_ext = $newStudent->student_code . "." . strtolower($request->avatar->extension());
                $result = $newStudent->addMedia($request->avatar)->usingFileName($fname_ext)->usingName($newStudent->student_code)->toMediaCollection('avatar');
            }
        }

        return redirect('students')->with('success','Nieuwe student is opgeslagen.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return View('students.show', ['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
