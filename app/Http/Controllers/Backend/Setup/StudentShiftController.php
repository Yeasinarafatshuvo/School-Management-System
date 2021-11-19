<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;
class StudentShiftController extends Controller
{
    //return page for student shift details
    public function ShiftView()
    {
        $data['studentShiftDetails'] = StudentShift::all();

        return view('backend.setup.shift.view_shift', $data);
    }

    //return page for add student shift
    public function StudentShiftAdd()
    {
        return view('backend.setup.shift.add_shift');
    }

    //store student shift details to db
    public function StudentShiftStore(Request $request)
    {
        //validation
        $validationData = $request->validate([
            'name' => 'required|unique:student_shifts,name'
        ]);

        $studentShiftInstanceData = new StudentShift();
        $studentShiftInstanceData->name = $request->name;
        $studentShiftInstanceData->save();

        $notification = array(
            'message' => 'Student Shift Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);


    }


    //return edit page for student shift details 
    public function StudentShiftEdit(Request $request, $id)
    {
        $studentShfitSpeceficData = StudentShift::find($id);

        return view('backend.setup.shift.edit_shift', compact('studentShfitSpeceficData'));

    }

   //edit student shift details as per id wise
   public function StudentShiftUpdate(Request $request, $id)
   {
        $studentShfitSpeceficData = StudentShift::find($id);

        //validation
        $validationData = $request->validate([
            'name' => 'required|unique:student_shifts,name,$validationData->id'
        ]);

        $studentShfitSpeceficData->name = $request->name;
        $studentShfitSpeceficData->save();

        $notification = array(
            'message' => 'Student Shift Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
   }

   //delete student shift details
   public function StudentShiftDelete($id)
   {
       $studentShiftSpeceficDetails = StudentShift::find($id);
       $studentShiftSpeceficDetails->delete();

       $notification = array(
        'message' => 'Student Shift Deleted  Successfully',
        'alert-type' => 'warning'
    );
    return redirect()->route('student.shift.view')->with($notification);


   }


}
