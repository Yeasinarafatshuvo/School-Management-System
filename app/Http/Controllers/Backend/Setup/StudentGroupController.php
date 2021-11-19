<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;
class StudentGroupController extends Controller
{
    //return page for student group details
    public function GroupView()
    {
        $data['studentGroupDetails'] = StudentGroup::all();
        return view('backend.setup.group.view_group', $data);
    }

    //return page for adding studentgroup add 
    public function StudentGroupAdd()
    {
        return view('backend.setup.group.add_group');
    }


    //store students group details
    public function StudentGroupStore(Request $request)
    {
        //validation
        $validation = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);


        $studentGroupInstance = new StudentGroup();
        $studentGroupInstance->name = $request->name;
        $studentGroupInstance->save();

        $notification = array(
            'message' => 'Student Group Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);

    }

    //return page for student group details edit
    public function StudentGroupEdit($id)
    {
        $studentGroupSpeceficData = StudentGroup::find($id);
        return view('backend.setup.group.edit_group', compact('studentGroupSpeceficData'));
    }

    //update student group details
    public function StudentGroupUpdate(Request $request, $id)
    {
        $studentGroupSpeceficData = StudentGroup::find($id);
        //validation
        $validation = $request->validate([
            'name' => 'required|unique:student_groups,name,studentGroupSpeceficData->id',
        ]);

        $studentGroupSpeceficData->name = $request->name;
        $studentGroupSpeceficData->save();

        $notification = array(
            'message' => 'Student Group Updated  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);

    }

    //delete student group data
    public function StudentGroupDelete($id)
    {
        $deleteStudentsgroupData = StudentGroup::find($id);
        $deleteStudentsgroupData->delete();

        $notification = array(
            'message' => 'Student Group Deleted  Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
}
