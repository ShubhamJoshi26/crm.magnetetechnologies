<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\department;

class DepartmentController extends Controller
{
    function Index()
    {
        return view('department/index');
    }

    function Create(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = department::getDataById($request->id);
            return view('department/create', ['data' => $data]);
        }
        if ($request->isMethod('post')) {
            $data['name'] = $request->name;
            $data['status'] = $request->status;
            if ($request->id != '') {
                $data['id'] = $request->id;
                $result = department::updateRecord($data);
                $msg = 'Department Updated Successfully';
            } else {
                $result = department::saveRecord($data);
                $msg = 'New Department Added Successfully';
            }
            if ($result) {
                return redirect('/department')->with('success', $msg);
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('department/create',['data' => []]);
    }

    function Delete(Request $request)
    {
       $result = department::destroy($request->id);
       if($result)
       {
        echo ("Department deleted successfully.");
       } else {
            echo 'Something went wrong'; }
    }
}