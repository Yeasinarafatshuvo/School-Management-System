<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\AssignStudent;
use  App\Models\User;
use  App\Models\DiscountStudent;
use  App\Models\StudentYear;
use  App\Models\StudentClass;
use  App\Models\StudentGroup;
use  App\Models\StudentShift;
use DB;

class StudentRegController extends Controller
{
    public function StudentRegView()
    {
        
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['years_id'] = StudentYear::orderBy('id', 'desc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id', 'desc')->first()->id;
        //dd($data['class_id']);
        $data['allStudentData'] = AssignStudent::where('year_id', $data['years_id'])->where('class_id',  $data['class_id'])->get();
        //dd($data['allStudentData']);

        return view('backend.student.student_reg.student_view', $data);

    }

    //student search function
    public function StudentSearch(Request $request)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['years_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
       
        $data['allStudentData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        //dd($data['allStudentData']);

        return view('backend.student.student_reg.student_view', $data);
    }

    //return page for adding student registration data
    public function StudentRegAdd()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.student_add', $data);
    }

    //store registration form data within multiple table using DB::transaction

    public function StudentRegStore(Request $request)
    {
        DB::transaction(function() use($request){
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first();
            //at first check how many student is register based on register student id will increment based on year
            if($student == null)
            {
                $firstReg = 0;
                $studentId = $firstReg +1;
                if($studentId < 10)
                {
                    $id_no = '000'.$studentId;
                }
                elseif($studentId < 100)
                {
                    $id_no = '00'.$studentId;
                }
                elseif($studentId < 1000)
                {
                    $id_no = '0'.$studentId;
                }
            }
            else
            { 
                $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student + 1;

                if($studentId < 10)
                {
                    $id_no = '000'.$studentId;
                }
                elseif($studentId < 100)
                {
                    $id_no = '00'.$studentId;
                }
                elseif($studentId < 1000)
                {
                    $id_no = '0'.$studentId;
                }
                
            }

            $final_id_no = $checkYear.$id_no;
            //store data to user table 
            $user = new User();
            $code = rand(0000,9999);
            $user->id_no =  $final_id_no;
            $user->code = $code;
            $user->password = bcrypt($code);
            $user->usertype = 'student';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if($request->file('image'))
            {
                $file = $request->file('image');            
                $fileName = date('YmHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images/'), $fileName);
                $user['image'] = $fileName;
            }

            $user->save();

            //store data to assign_student table
            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id; //student_id == user_id
            // dd($request->class_id);
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            //store data to discount data
            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1'; // Here value is 1 because fee_category_id registration fee id 1 
            $discount_student->discount = $request->discount; 
            $discount_student->save();

        });

        $notification = array(
            'message' => 'Student Registration Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);


    }
}
