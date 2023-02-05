<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\module;

class ModuleController extends Controller
{
    public static function Modules()
    {
        $Module = module::getRecords();
        return view('module/index', ['data' => $Module]);
    }

    function Create(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = module::getDataById($request->id);
            return view('module/create', ['data' => $data[0]]);
        }
        if ($request->isMethod('post')) {
            $data['modulename'] = $request->modulename;
            if ($request->moduleid != '') {
                $data['moduleid'] = $request->moduleid;
                $msg = 'Module Updated Successfully';
            } else {
                $msg = 'New Module Added Successfully';
            }
            $result = module::saveRecord($data);
            if ($result) {
                return redirect('/module')->with('success', $msg);
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('module/create',['data' => []]);
    }

    function Delete(Request $request)
    {
       $result = module::destroy($request->id);
       if($result)
       {
        echo ("Module deleted successfully.");
       } else {
            echo 'Something went wrong'; }
    }
}