<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Examtype;
class ExamtypeController extends Controller
{
    //return exam type page for details
    public function ViewExamType()
    {
        $data['examTypeData'] = Examtype::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }

    //return page for add exam type details
    public function ExamTypeAdd()
    {
        return view('backend.setup.exam_type.add_exam_type');

    }

    //store exam type details
    public function ExamTypeStore(Request $request)
    {
        //validation
        $validationData = $request->validate([
            'name' => 'required|unique:examtypes,name',
        ]);

        $examTypeInstance = new Examtype();
        $examTypeInstance->name = $request->name;
        $examTypeInstance->save();

        $notification = array(
            'message' => 'Exam Type Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('exam.type.view')->with($notification);

    }

    //edit exam type
    public function ExamTypeEdit(Request $request, $id)
    {
        $examtypeEditData = Examtype::find($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('examtypeEditData'));
    }

    //update exam type
    public function ExamTypeUpdate(Request $request, $id)
    {
        $examTypeSpeceficData = Examtype::find($id);
        
        //validation
        $validationData = $request->validate([
            'name' => 'required|unique:examtypes,name, $examTypeSpeceficData->id',
        ]);

      
        $examTypeSpeceficData->name = $request->name;
        $examTypeSpeceficData->save();

        $notification = array(
            'message' => 'Exam Type Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }

    //delete specefic exam type data
    public function ExamTypeDelete($id)
    {
        $deleteExamTypeData = Examtype::find($id);
        $deleteExamTypeData->delete();

        $notification = array(
            'message' => 'Exam Type Deleted  Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('exam.type.view')->with($notification);
    }
}
