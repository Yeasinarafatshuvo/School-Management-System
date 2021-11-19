<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DesignationMOdel;
class DesignationController extends Controller
{
    //return page for view designation details
    public function DesignationView()
    {
        $data['designationData'] = DesignationMOdel::all();
        return view('backend.setup.designation.view_designation', $data);
    }

    //return page for store designatino data
    public function DesignationAdd()
    {
        return view('backend.setup.designation.add_designation');
    }


    //store designation data
    public function DesignationStore(Request $request)
    {
        //data validation
        $validatinData = $request->validate([
            'name' => 'required|unique:designation_m_odels,name'
        ]);
        
        //create instance of Desination model
        $instanceDesignationMOdel = new DesignationMOdel();
        $instanceDesignationMOdel->name =$request->name;
        $instanceDesignationMOdel->save();

        //send notification after after save data
        $notification = array(
            'message' => 'Designation Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('designation.view')->with($notification);

    }

    //return page for edit designation page
    public function DesignationEdit($id)
    {
        $editDesignationMOdel = DesignationMOdel::find($id);
        return view('backend.setup.designation.edit_designation', compact('editDesignationMOdel'));
    }

    //update data
    public function DesignationUpdate(Request $request, $id)
    {
        $designatinData = DesignationMOdel::find($id);
        //data validation
        $validatinData = $request->validate([
            'name' => 'required|unique:designation_m_odels,name, $validatinData->id'
        ]);

        $designatinData->name = $request->name;
        $designatinData->save();

        //send notification after after updating data
        $notification = array(
            'message' => 'Designation Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('designation.view')->with($notification);

    }

    //delete designation
    public function DesignationDeleted($id)
    {
        $designationDelete =  DesignationMOdel::find($id);
        $designationDelete->delete();

         //send notification  after deletomg data
         $notification = array(
            'message' => 'Designation Deleted  Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('designation.view')->with($notification);


    }


}
