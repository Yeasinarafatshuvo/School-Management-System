<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;
class SchoolSubjectController extends Controller
{
    //return view of school subject page
    public function ViewSchoolSubject()
    {
        $data['schoolSubjectData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', $data);
    }

    //return page for add school subject
    public function SchoolSubjectAdd()
    {
        return view('backend.setup.school_subject.add_school_subject');
    }

    //store subject data
    public function SchoolSubjectStore(Request $request)
    {
        //validation
        $validationData = $request->validate([
            'name' => 'required |unique:school_subjects,name' 
        ]);

        //store
        $subjectInstance = new SchoolSubject();

        $subjectInstance->name = $request->name;
        $subjectInstance->save();

        $notification = array(
            'message' => 'Student Subject Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('school.subject.view')->with($notification);

    }

    //return page for edit school subject
    public function SchoolSubjectEdit($id)
    {
        $speceficSubjectData = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_school_subject', compact('speceficSubjectData'));
    }

    //update subject data
    public function SchoolSubjectUpdate(Request $request, $id)
    {
        $speceficSubjectData = SchoolSubject::find($id);

        //validation 

        $validationData = $request->validate([
            'name' => 'required |unique:school_subjects,name' 
        ]);

        //store

         //store
         $subjectInstance = new SchoolSubject();

         $subjectInstance->name = $request->name;
         $subjectInstance->save();
 
         $notification = array(
             'message' => 'Student Subject Updated  Successfully',
             'alert-type' => 'success'
         );
         return redirect()->route('school.subject.view')->with($notification);


    }

    //delete subject data id wise
    public function SchoolSubjectDelete($id)
    {
        $speceficSubjectData = SchoolSubject::find($id);
        $speceficSubjectData->delete();

        $notification = array(
            'message' => 'Student Subject Deleted  Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }


}
