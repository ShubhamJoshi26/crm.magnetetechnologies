<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\product;

class ProductController extends Controller
{
    public static function index()
    {
        $product = product::getRecords();
        return view('productDetail/index', ['data' => $product]);
    }

    function Create(Request $request)
    {

        if ($request->isMethod('get') && !empty($request->id)) {
            $data = product::getDataById($request->id);
            return view('productDetail/create', ['data' => $data[0]]);
        }
        if ($request->isMethod('post')) {
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['status'] = $request->status;
            $data['category_id'] = $request->category_id;
            if ($request->id != '') {
                $data['id'] = $request->id;
                $msg = 'Product Updated Successfully';
            } else {
                $msg = 'New Product Added Successfully';
            }
            $result = product::saveRecord($data);
            if ($result) {
                return redirect('/productDetail')->with('success', $msg);
            } else {
                return redirect('/')->with('failure', 'Something went wrong');
            }
        }
        return view('productDetail/create',['data' => []]);
    }

    function Delete(Request $request)
    {
       $result = product::destroy($request->id);
       if($result)
       {
        echo ("Product deleted successfully.");
       } else {
            echo 'Something went wrong'; }
    }
}