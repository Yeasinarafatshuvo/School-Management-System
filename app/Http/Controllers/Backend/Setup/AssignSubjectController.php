<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\SchoolSubject;


class AssignSubjectController extends Controller
{
    //return view for assin subject data
    public function ViewAssignSubject()
    {
        // $data['allData'] = AssignSubject::all();
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }

    //return view for adding option assign subject value
    public function AddAssignSubject()
    {
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        //dd($data);
        return view('backend.setup.assign_subject.add_assign_subject', $data);


    }

    //store assign subject data
    public function StoreAssignSubject(Request $request)
    {
        $subjectCount = count($request->subject_id);
        if($subjectCount !== NULL)
        {
            for($i = 0; $i<$subjectCount; $i++)
            {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
            }
        }

        $notification = array(
            'message' => 'Subject Assign Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('assign.subject.view')->with($notification);


    }

    //return view page for edit assign subject
    public function EditAssignSubject($class_id)
    {
        $data['editedData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        // dd($data['editedData'])->toArray();
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        //dd($data);
        return view('backend.setup.assign_subject.edit_assign_subject', $data);

    }

    //update specefic assign subject data
    public function UpdateAssignSubject(Request $request, $class_id)
    {
        //dd($request->subject_id );
        if($request->subject_id == NULL)
        {
            $notification = array(
                'message' => 'Sorry You Do not Select Any Subject',
                'alert-type' => 'error'
            );
            return redirect()->route('assign.subject.edit', $class_id)->with($notification);
        }
        else
        {
            $subjectCount = count($request->subject_id);
            if($subjectCount !== NULL)
            {
                //at first it check with our requested it with database id than it deleted all old data 
                AssignSubject::where('class_id', $class_id)->delete();
                for($i = 0; $i<$subjectCount; $i++)
                {
                    $assign_subject = new AssignSubject();
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->pass_mark = $request->pass_mark[$i];
                    $assign_subject->subjective_mark = $request->subjective_mark[$i];
                    $assign_subject->save();
                }
            }
        }

        $notification = array(
            'message' => 'Subject Assign Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('assign.subject.view')->with($notification);

    }


    //details assign subject data
    public function DetailsAssignSubject($class_id)
    {
        $data['detailsData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.details_assign_subject', $data);

    }

    


}
