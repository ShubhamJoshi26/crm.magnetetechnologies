<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    function CreateCustomer(Request $CustomerData)
    {
        $firstname = $CustomerData->firstname;
        $lastname = $CustomerData->lastname;
        $mobile = $CustomerData->mobile;
        $email = $CustomerData->email;
        $country = $CustomerData->country;
        $service = $CustomerData->service;
        $contacttype = $CustomerData->contacttype;
        $clientcategory = $CustomerData->clientcategory;
        $paymentdetail = $CustomerData->paymentdetails;
        $fulladdress = $CustomerData->address;
        $status = $CustomerData->status;
        $created_on = time();
        $updated_on = time();
        $created_by = Session()->get('id');
        $updated_by = Session()->get('id');
        if(!empty($_FILES) && $_FILES['customer_photo']['name']!='')
        {
            $imageName = time().'.'.$CustomerData->customer_photo->extension();  
            $CustomerData->customer_photo->move(public_path('uploads/clientphoto'), $imageName);
            $profile_path = 'uploads/clientphoto/'.$imageName;
            $AddCustomerData = DB::insert('INSERT INTO `customer` (`firstname`,`lastname`,`mobile`,`email`,`country`,`service`,`contacttype`,`clientcategory`,`paymentdetail`,`fulladdress`,`status`,`profile_path`,`created_on`,`updated_on`,`created_by`,`updated_by`) VALUES ("'.$firstname.'","'.$lastname.'",'.$mobile.',"'.$email.'","'.$country.'","'.$service.'","'.$contacttype.'","'.$clientcategory.'","'.$paymentdetail.'","'.$fulladdress.'","'.$status.'","'.$profile_path.'","'.$created_on.'","'.$updated_on.'","'.$created_by.'","'.$updated_by.'")');
            
        }
        else
        {
            $AddCustomerData = DB::insert('INSERT INTO `customer` (`firstname`,`lastname`,`mobile`,`email`,`country`,`service`,`contacttype`,`clientcategory`,`paymentdetail`,`fulladdress`,`status`,`created_on`,`updated_on`,`created_by`,`updated_by`) VALUES ("'.$firstname.'","'.$lastname.'",'.$mobile.',"'.$email.'","'.$country.'","'.$service.'","'.$contacttype.'","'.$clientcategory.'","'.$paymentdetail.'","'.$fulladdress.'","'.$status.'","'.$created_on.'","'.$updated_on.'","'.$created_by.'","'.$updated_by.'")');
            
        }
        if($AddCustomerData==1)
        {
            return redirect('/AddCustomer')->with('success', 'Client Added Successfully');
        }
        else
        {
            return redirect('/AddCustomer')->with('error', 'Client Not Added');
        }
    }
    public static function getCustomerList()
    {
        $CustomerList = DB::select('SELECT * FROM `customer`');
        return json_encode(array('success'=>'true','data'=>$CustomerList,'error_code'=>'20001'));
    }
}
