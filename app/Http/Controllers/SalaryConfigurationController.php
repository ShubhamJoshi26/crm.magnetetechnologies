<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\salaryConfiguration;

class SalaryConfigurationController extends Controller
{
    function Index()
    {
        return view('salary-configuration/index');
    }

    // function Editconfig($id){
    //     return view('salary-configuration/editconfig');
    // }

    function Editconfig(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = salaryConfiguration::getDataById($request->id);
            if (!empty($data)) {
                return view('module/create', ['data' => $data[0]]);
            }else{
                $data['employee_id'] = $request->id;
                return view('salary-configuration/editconfig', ['data' => $data]);
            }
        }
        if ($request->isMethod('post')) {
            $data[] = $request->post();
         
            $result = salaryConfiguration::saveRecord($data[0]);
            if ($result) {
                return redirect('/salary-configuration')->with('success', 'Salary Configuration Updated Successfully');
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('salary-configuration/editconfig', ['data' => []]);
    }

}