<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;

class FeeAmountController extends Controller
{
    //return Fee Amount page 
    public function ViewFeeAmount()
    {
        // $data['allFeeCategoryAmountData'] = FeeCategoryAmount::all();
        $data['allFeeCategoryAmountData'] = FeeCategoryAmount::select('fee_category_id')
                    ->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    //return page for fee amount add
    public function FeeAmountAdd()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }

    //store fee  amount
    public function FeeAmountStore(Request $request)
    {
        $countClass = count($request->class_id);

        if($countClass !=NULL)
        {
            for($i = 0; $i<$countClass; $i++)
            {
                $feeAmountData = new FeeCategoryAmount();
                $feeAmountData->fee_category_id = $request->fee_category_id;
                $feeAmountData->class_id = $request->class_id[$i];
                $feeAmountData->amount = $request->amount[$i];
                $feeAmountData->save();

            }

        }

        $notification = array(
            'message' => 'Student Fee amount Inserted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.amount.view')->with($notification);


    }

    //return page for edit fee amount
    public function FeeAmountEdit($fee_category_id)
    {
       $data['editFeeAmountData'] =  FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        //dd($data['editFeeAmountData']->toArray());
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    //store fee amount off data
    public function FeeAmountUpdate(Request $request, $fee_category_id)
    {
        if($request->class_id == NULL)
        {
            $notification = array(
                'message' => 'Sorry You Do not Select Any Class Amount',
                'alert-type' => 'error'
            );
            return redirect()->route('fee.amount.edit', $fee_category_id)->with($notification);
        }
        else
        {
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
                for($i = 0; $i<$countClass; $i++)
                {
                    $feeAmountData = new FeeCategoryAmount();
                    $feeAmountData->fee_category_id = $request->fee_category_id;
                    $feeAmountData->class_id = $request->class_id[$i];
                    $feeAmountData->amount = $request->amount[$i];
                    $feeAmountData->save();

                }
      
            $notification = array(
                'message' => 'Student Fee amount Updated  Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('fee.amount.view')->with($notification);
        
        }

    }

    //details of fee amount data
    public function FeeAmountDetails($fee_category_id)
    {
        $data['detailsFeeAmountData'] =  FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                        ->orderBy('class_id', 'asc')->get();
         return view('backend.setup.fee_amount.details_fee_amount', $data);               

    }

}
