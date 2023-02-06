<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\employee;
use App\Models\User;

class EmployeeController extends Controller
{
    function Index()
    {
        return view('employee/index');
    }

    function Create(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = employee::getDataById($request->id);
            $userData = User::find($data->user_id);
            return view('employee/create', ['data' => $data,'userData' => $userData]);
        }
        if ($request->isMethod('post')) {
            $data['employee_id'] = $request->employee_id;
            $data['name'] = $request->name;
            $data['fathername'] = $request->fathername;
            $data['address'] = $request->address;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['designation_id'] = $request->designation_id;
            $data['department_id'] = $request->department_id;
            $data['profile'] = $request->profile;
            $data['status'] = $request->status;
            $data['password'] = $request->password;

            if (!empty($_FILES) && $_FILES['profile_photo']['name'] != '') {
                $imageName = time() . $_FILES['profile_photo']['name'].'.' . $request->profile_photo->extension();
                $request->profile_photo->move(public_path('uploads/userprofile'), $imageName);
                $data['profile_photo'] = $imageName;

            }


            if ($request->id != '') {
                $data['id'] = $request->id;
                $data['user_id'] = $request->user_id;
                $msg = 'Employee Updated Successfully';
            } else {
                $msg = 'New Employee Added Successfully';
            }
            $result = employee::saveRecord($data);
            if ($result) {
                return redirect('/employee')->with('success', $msg);
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('employee/create', ['data' => []]);
    }

    function Delete(Request $request)
    {
        $result = employee::destroy($request->id);
        if ($result) {
            echo ("Employee deleted successfully.");
        } else {
            echo 'Something went wrong';
        }
    }
    public static function getEmployeeById($empid)
    {
        $empdata = DB::table('employees')->where('id','=',$empid)->get();
        return json_encode(array('success'=>'true','data'=>$empdata,'error_code'=>'10001'));
    }
}