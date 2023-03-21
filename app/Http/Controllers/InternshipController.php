<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public static function SaveInterestForm(Request $request)
    {
        
        $input = $request->all();
        $InterestForm = Internship::create($input);
        if(isset($InterestForm->id))
        {
            $id = $InterestForm->id;
            $StudentInterestNumber = 'INT-'.$id;
            $interest = Internship::find($id);
            $interest->interestno = $StudentInterestNumber;
            if($interest->save())
            {
                $InterestForm['interestno'] = $StudentInterestNumber;
                return json_encode(array('success'=>'true','data'=>$InterestForm,'error_code'=>200));
            }
            else
            {
                return json_encode(array('success'=>'true','data'=>$InterestForm,'error_code'=>200,'massege'=>'Error In Generate Interest Number'));
            }
            
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>400));
        }
    }
}
