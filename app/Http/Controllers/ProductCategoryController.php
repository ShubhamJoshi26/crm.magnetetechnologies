<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\productCategory;

class ProductCategoryController extends Controller
{
    public static function index()
    {
        $productCategory = productCategory::getRecords();
        return view('productCategory/index', ['data' => $productCategory]);
    }

    function Create(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = productCategory::getDataById($request->id);
            return view('productCategory/create', ['data' => $data[0]]);
        }
        if ($request->isMethod('post')) {
            $data['name'] = $request->name;
            if ($request->id != '') {
                $data['id'] = $request->id;
                $msg = 'Product Category Updated Successfully';
            } else {
                $msg = 'New Product Category Added Successfully';
            }
            $result = productCategory::saveRecord($data);
            if ($result) {
                return redirect('/productCategory')->with('success', $msg);
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('productCategory/create',['data' => []]);
    }

    function Delete(Request $request)
    {
       $result = productCategory::destroy($request->id);
       if($result)
       {
        echo ("Product Category deleted successfully.");
       } else {
            echo 'Something went wrong'; }
    }
}