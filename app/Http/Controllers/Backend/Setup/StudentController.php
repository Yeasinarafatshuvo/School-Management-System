<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
class StudentController extends Controller
{
    //retrive data from student_classes table
    public function StudentView()
    {
        $data['studetnClassData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    //return page for adding student class details
    public function StudentClassAdd()
    {
        return view('backend.setup.student_class.add_class');
    }

    public function StudentClassStore(Request $request)
    {
        //validate input
        $validateData = $request->validate([
            'name' => 'required | unique:student_classes,name',
        ]);

        $studentClassData = new StudentClass();
        $studentClassData->name = $request->name;
        $studentClassData->save();

        $notification = array(
            'message' => 'Student Class Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }

    //return page for edited student class data
    public function StudentClassEdit($id)
    {
        $editStudentClassData = StudentClass::find($id);
        return view('backend.setup.student_class.edit_class', compact('editStudentClassData'));
    }

    //update student class
    public function StudentClassUpdate(Request $request, $id)
    {
        $studentClassData = StudentClass::find($id);
        $validateData = $request->validate([
            'name' => 'required | unique:student_classes,name,.StudetnClassAdd->id',
        ]);
        $studentClassData->name = $request->name;
        $studentClassData->save();

        $notification = array(
            'message' => 'Student Class Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }

    //Delete Student class
    public function StudentClassDelete($id)
    {
        $studentClassData = StudentClass::find($id);
        $studentClassData->delete();

        $notification = array(
            'message' => 'Student Class Deleted  Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->route('student.class.view')->with($notification);
    }

   
    
    

}
