<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;
class StudentYearController extends Controller
{
    //return student view page
    public function YearView()
    {
        $data['studentYearData'] = StudentYear::all();
        return view('backend.setup.year.view_year', $data);
    }

    //return page for add student year data
    public function StudentYearAdd()
    {
        return view('backend.setup.year.add_year');
    }

    //store student year data
    public function StudentYearStore(Request $request)
    {
        //validation
        $validateData = $request->validate([
            'name' => 'required | unique:student_years,name',
        ]);

        $studentYear = new StudentYear();
        
        $studentYear->name = $request->name;
        $studentYear->save();

        $notification = array(
            'message' => 'Student Year Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }

    //return student year page
    public function StudentYearEdit($id)
    {
        $studentYearSpeceficData = StudentYear::find($id);
        return view('backend.setup.year.edit_year', compact('studentYearSpeceficData'));
    }

    //update student year data
    public function StudentYearUpdate(Request $request, $id)
    {
        $studentYearSpeceficData = StudentYear::find($id);

        //validate
        $validateData = $request->validate([
            'name' => 'required | unique:student_years,name,.$studentYearSpeceficData->id',
        ]);

        $studentYearSpeceficData->name = $request->name;
        $studentYearSpeceficData->save();

        $notification = array(
            'message' => 'Student Year Update  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);

    }

    public function StudentYearDelete($id)
    {
        $studetnDeleteData = StudentYear::find($id);
        $studetnDeleteData->delete();

        $notification = array(
            'message' => 'Student Year Deleted  Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
}
