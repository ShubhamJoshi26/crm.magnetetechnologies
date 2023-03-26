<?php

namespace App\Http\Controllers;

use App\Models\StudnetEnquiry;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function CreateStudentEnquiry(Request $request)
    {
        if(!empty($request->all()))
        {
            if($savedata = StudnetEnquiry::create($request->all()))
            {
                
                $id = $savedata->id;
                $addenquiryno = StudnetEnquiry::find($savedata->id);
                $enquiryno = 'ENQ-2023-24/00'.$id;
                $addenquiryno->enquiryno = $enquiryno;
                if($addenquiryno->save())
                {
                    return redirect($request->thankspage.'?enquiryno='.$enquiryno,'302',['enquiryno'=>$enquiryno]);
                }
                else
                {
                    return redirect($request->errorpage.'?msg=Autogeneration Issue');
                }
            }
            else
            {
                return redirect($request->errorpage.'?msg=Internal Server Issue');
            }
           
        }
    }
}
