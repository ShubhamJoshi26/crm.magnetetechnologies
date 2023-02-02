<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\designation;

class DesignationController extends Controller
{
    function Index()
    {
        return view('designation/index');
    }

    function Create(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = designation::getDataById($request->id);
            return view('designation/create', ['data' => $data]);
        }
        if ($request->isMethod('post')) {
            $data['name'] = $request->name;
            $data['status'] = $request->status;
            if ($request->id != '') {
                $data['id'] = $request->id;
                $result = designation::updateRecord($data);
                $msg = 'Designation Updated Successfully';
            } else {
                $result = designation::saveRecord($data);
                $msg = 'New Designation Added Successfully';
            }
            if ($result) {
                return redirect('/designation')->with('success', $msg);
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('designation/create',['data' => []]);
    }

    function Delete(Request $request)
    {
       $result = designation::destroy($request->id);
       if($result)
       {
        echo ("Designation deleted successfully.");
       } else {
            echo 'Something went wrong'; }
    }
}