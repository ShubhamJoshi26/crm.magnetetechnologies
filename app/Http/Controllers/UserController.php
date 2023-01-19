<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function Login(Request $data)
    {
        if($data->email!='' && $data->password!='')
        {
            $UserData = DB::table('users')->where('email','=',$data->email)->where('password','=',md5($data->password))->get();
            $user = array();
            foreach($UserData as $items)
            {
                
               $user['name'] = $items->name;
               $user['id'] = $items->id;
               $user['email'] = $items->email;
            }
            
               if(!empty($user) && $user['id']!='')
               {
                   session()->put(['user_status'=>'logedin','name'=>$user['name'],'id'=>$user['id'],'email'=>$user['email']]);
                   return redirect('/',302,['users'=>$UserData])->with('success','Login Successfull');
               }
               else
               {
                   return redirect('/Login')->with('error','Invalid UserId or Password');
               }
        }
    }
    function LogoutUser()
    {
        Session()->flush();
        return redirect('/Login');
    }
    public static function getUserById($id)
    {
        $UserData = DB::select('Select * from `users` where id="'.$id.'" ');
        return json_encode(array('success'=>'true','data'=>$UserData,'error_code'=>'10001'));
         
    }
    function UpdateUser(Request $UserUpdateData)
    {
        // print_r($UserUpdateData->profile_photo);
        $id = $UserUpdateData->userid;
        $name = $UserUpdateData->name;
        $email = $UserUpdateData->email;
        $designation = $UserUpdateData->designation;
        $mobile = $UserUpdateData->mobile;
        $address = $UserUpdateData->address;
        if(!empty($_FILES) && $_FILES['profile_photo']['name']!='')
        {
            $imageName = time().'.'.$UserUpdateData->profile_photo->extension();  
            $UserUpdateData->profile_photo->move(public_path('uploads/userprofile'), $imageName);
            $path = 'uploads/userprofile/'.$imageName;
            $UpdateUser = DB::table('users')->where('id','=',$id)->update(['name'=>$name,'email'=>$email,'designation'=>$designation,'mobile'=>$mobile,'address'=>$address,'profile_photo_path'=>$path]);
        }
        else
        {
            $UpdateUser = DB::table('users')->where('id','=',$id)->update(['name'=>$name,'email'=>$email,'designation'=>$designation,'mobile'=>$mobile,'address'=>$address]);
        }
        if($UpdateUser==1)
        {
            return redirect('/UserProfile')->with('success', 'Profile Updated');
        }
        else
        {
            return redirect('/UserProfile')->with('error', 'Profile Not Updated');
        }
    }
    public static function getAllUsers()
    {
        $UserData = DB::select('Select * from `users`');
        return json_encode(array('success'=>'true','data'=>$UserData,'error_code'=>'10001'));
    }
    function CreateUser(Request $data)
    {
        $name = $data->name;
        $email = $data->email;
        $mobile = $data->mobile;
        $designation = $data->designation;
        $usertype = $data->usertype;
        $status = $data->status;
        $address = $data->address;
        $password = md5($data->password);
        // $user_photo = $data->user_photo;
        $created_at = time();
        $updated_at = time();
        $created_by = Session()->get('id');
        $updated_by = Session()->get('id');
        if(!empty($_FILES) && $_FILES['user_photo']['name']!='')
        {
            $imageName = time().'.'.$data->user_photo->extension();  
            $data->user_photo->move(public_path('uploads/userprofile'), $imageName);
            $profile_path = 'uploads/userprofile/'.$imageName;
            $AddUserData = DB::insert('INSERT INTO `users` (`name`,`mobile`,`email`,`designation`,`usertype`,`status`,`address`,`profile_photo_path`,`created_at`,`updated_at`,`created_by`,`updated_by`,`password`) VALUES ("'.$name.'",'.$mobile.',"'.$email.'","'.$designation.'","'.$usertype.'","'.$status.'","'.$address.'","'.$profile_path.'","'.$created_at.'","'.$updated_at.'","'.$created_by.'","'.$updated_by.'","'.$password.'")');
            
        }
        else
        {
            $AddUserData = DB::insert('INSERT INTO `users` (`name`,`mobile`,`email`,`designation`,`usertype`,`status`,`address`,`created_at`,`updated_at`,`created_by`,`updated_by`,`password`) VALUES ("'.$name.'",'.$mobile.',"'.$email.'","'.$designation.'","'.$usertype.'","'.$status.'","'.$address.'","'.$created_at.'","'.$updated_at.'","'.$created_by.'","'.$updated_by.'","'.$password.'")');
            
        }
        if($AddUserData==1)
        {
            return redirect('/AddUser')->with('success', 'User Added Successfully');
        }
        else
        {
            return redirect('/AddUser')->with('error', 'User Not Added');
        }
    }
}
