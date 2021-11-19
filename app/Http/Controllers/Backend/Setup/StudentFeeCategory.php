<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
class StudentFeeCategory extends Controller
{
    //return fee category page details
    public function ViewFeeCat()
    {
        $data['feeCatData'] = FeeCategory::all();
        return view('backend.setup.fee_cat.view_fee_cat', $data);
    }

    //return page for add fee category 
    public function FeeCatAdd()
    {
       return view('backend.setup.fee_cat.add_fee');

    }

    //store fee category data in db
    public function FeeCatStore(Request $request)
    {
         //validation
         $validationData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $feeCategoryInstance = new FeeCategory();
        $feeCategoryInstance->name = $request->name;
        $feeCategoryInstance->save();

        $notification = array(
            'message' => 'Student Fee Category Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.category.view')->with($notification);

    }

    //return page for fee category edit
    public function FeeCatEdit($id)
    {
        $feeCategorySpeceficData = FeeCategory::find($id);
        return view('backend.setup.fee_cat.edit_fee_cat', compact('feeCategorySpeceficData'));

    }

    //updaet fee category data
    public function FeeCatUpdate(Request $request, $id)
    {
        $feeCategorySpeceficData = FeeCategory::find($id);
        //validation
        $validationData = $request->validate([
            'name' => 'required|unique:fee_categories,name, $feeCategorySpeceficData->id',
        ]);


        $feeCategorySpeceficData->name = $request->name;
        $feeCategorySpeceficData->save();

        $notification = array(
            'message' => 'Student Fee Category Updated  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }

    //delete fee category details
    public function FeeCatDelete($id)
    {
        $deleteFeeCategoryData = FeeCategory::find($id);
        $deleteFeeCategoryData->delete();

        $notification = array(
            'message' => 'Student Fee Category Deleted  Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }
}
