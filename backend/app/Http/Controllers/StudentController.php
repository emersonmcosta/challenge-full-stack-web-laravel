<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Traits\HandleCustomResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    use HandleCustomResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return new StudentResource(Student::all());
        } catch (\Throwable $th) {
            return self::handleError($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStudentRequest $request)
    {
        try {
            return Student::create($request->all());
        } catch (\Throwable $th) {
            return self::handleError($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $idStudent)
    {
        try {
            return new StudentResource(Student::findOrFail($idStudent));
        } catch (\Throwable $th) {
            return self::handleError($th);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request,int $idStudent)
    {
        try {
            $student = Student::find($idStudent);
        
            if($student){
                return self::responseAttemptUpdateStudent($student->update($request->all()));
            }

            return self::studentNotFound($idStudent);
        } catch (\Throwable $th) {
            return self::handleError($th);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $idStudent)
    {
        try {
            $student = Student::find($idStudent);
        
            if($student){
                return self::responseAttemptDeleteStudent($student->delete());
            }

            return self::studentNotFound($idStudent);
        } catch (\Throwable $th) {
            return self::handleError($th);
        }        
    }
}
