<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    function Login(Request $data)
    {
        Log::info('Login',array('data'=>$data));
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
                   Log::info('Login Data Fetched',array('userdata'=>$user));
                   session()->put(['user_status'=>'logedin','name'=>$user['name'],'id'=>$user['id'],'email'=>$user['email']]);
                   return redirect('/',302,['users'=>$UserData])->with('success','Login Successfull');
               }
               else
               {
                   Log::alert('Login Invalid',array('data'=>''));
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
        if(!empty($UserData[0]) && $UserData[0]->id!='')
        {
            return json_encode(array('success'=>'true','data'=>$UserData,'error_code'=>'10001'));
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>'10001')); 
        }
        
         
    }
    function UpdateProfile(Request $UserUpdateData)
    {
        // print_r($UserUpdateData->profile_photo);
        $id = $UserUpdateData->userid;
        $name = $UserUpdateData->name;
        $email = $UserUpdateData->email;
        $designation = $UserUpdateData->designation;
        $mobile = $UserUpdateData->mobile;
        $address = $UserUpdateData->address;
        $github = $UserUpdateData->github;
        $twitter = $UserUpdateData->twitter;
        $instagram = $UserUpdateData->instagram;
        $facebook = $UserUpdateData->facebook;
        if(!empty($_FILES) && $_FILES['profile_photo']['name']!='')
        {
            $imageName = time().'.'.$UserUpdateData->profile_photo->extension();  
            $UserUpdateData->profile_photo->move(public_path('uploads/userprofile'), $imageName);
            $path = 'uploads/userprofile/'.$imageName;
            $UpdateUser = DB::table('users')->where('id','=',$id)->update(['name'=>$name,'email'=>$email,'designation'=>$designation,'mobile'=>$mobile,'address'=>$address,'profile_photo_path'=>$path,'github'=>$github,'twitter'=>$twitter,'instagram'=>$instagram,'facebook'=>$facebook]);
        }
        else
        {
            $UpdateUser = DB::table('users')->where('id','=',$id)->update(['name'=>$name,'email'=>$email,'designation'=>$designation,'mobile'=>$mobile,'address'=>$address,'github'=>$github,'twitter'=>$twitter,'instagram'=>$instagram,'facebook'=>$facebook]);
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
    function UpdateUser(Request $data)
    {
        $name = $data->name;
        $email = $data->email;
        $mobile = $data->mobile;
        $designation = $data->designation;
        $usertype = $data->usertype;
        $status = $data->status;
        $address = $data->address;
        $id = $data->userid;
        
        // $password = md5($data->password);
        // $user_photo = $data->user_photo;
        // $created_at = time();
        $updated_at = time();
        // $created_by = Session()->get('id');
        $updated_by = Session()->get('id');
        if(!empty($_FILES) && $_FILES['user_photo']['name']!='')
        {
            $imageName = time().'.'.$data->user_photo->extension();  
            $data->user_photo->move(public_path('uploads/userprofile'), $imageName);
            $profile_path = 'uploads/userprofile/'.$imageName;
            $AddUserData = DB::insert('UPDATE `users` SET  `name`= "'.$name.'",`mobile`='.$mobile.',`email`="'.$email.'",`designation`="'.$designation.'",`usertype`="'.$usertype.'",`status`="'.$status.'",`address`="'.$address.'",`profile_photo_path`="'.$profile_path.'",`updated_at`="'.$updated_at.'",`updated_by`="'.$updated_by.'" WHERE id="'.$id.'"');
            
        }
        else
        {
            $AddUserData = DB::insert('UPDATE `users` SET  `name`= "'.$name.'",`mobile`='.$mobile.',`email`="'.$email.'",`designation`="'.$designation.'",`usertype`="'.$usertype.'",`status`="'.$status.'",`address`="'.$address.'",`updated_at`="'.$updated_at.'",`updated_by`="'.$updated_by.'" WHERE id="'.$id.'"');
            
        }
        if($AddUserData==1)
        {  
           
            return redirect('/EditUser/'.$id.'',302,['id'=>$data->userid])->with('success', 'User Updated Successfully');
        }
        else
        {
            
            return redirect('/EditUser/'.$id.'',302,['id'=>$data->userid])->with('error', 'User Not Updated');
        }
    }
    public static function getAllModules()
    {
        $Module = DB::select('Select * from `module`');
        return json_encode(array('success'=>'true','data'=>$Module,'error_code'=>'10001'));
    }
    function UpdateUserPermissions(Request $UserPermissionData)
    {
       $permissions = $UserPermissionData->request->all();
       echo '<pre>';
       $moduledata = self::getAllModules();
       $modules = json_decode($moduledata,true);
       // $moduleforcheck = array();
       foreach($modules['data'] as $module)
       {
           $moduleforcheck[] = $module['modulename'];
       }
       
       foreach($permissions['permission'] as $key=> $permission)
       {
           $checkpermission = DB::select('select * from permissions where `userid`='.$permissions['userid'].' and `permissionname`="'.$key.'"');
           if(count($checkpermission)==0)
           {
                $createduser = Session()->get('id');
                $Addpermission = DB::select('insert into permissions (`permissionname`,`userid`,`modulename`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ("'.$key.'","'.$permissions['userid'].'","'.$key.'","'.$createduser.'","'.$createduser.'","'.time().'","'.time().'")');
           }
           
       }
       foreach($moduleforcheck as $modulecheck)
        {
            
            if(!key_exists($modulecheck,$permissions['permission']))
            {  
                $deletepermission = DB::select('delete from permissions where `userid`='.$permissions['userid'].' and `permissionname`="'.$modulecheck.'"');
                print_r($deletepermission);
            }
        }
         return redirect('/Permissions')->with('success','Permission Updated Successfully'); 
      
      
    }
    public static function getUserPermissions($id)
    {
        if($id!='')
        {
            $permissions = DB::table('permissions')->where('userid','=',$id)->get();
            if(!empty($permissions[0]) && $permissions[0]->permissionid!='')
        {
            return json_encode(array('success'=>'true','data'=>$permissions,'error_code'=>'10001'));
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>'10001')); 
        }
        }
    }
    public static function getUserPermissionByName($name,$userid)
    {
        Log::info('getUserPermissionByName',array('data'=>array('name'=>$name,'userid'=>$userid)));
        if($name!='' && $userid!='')
        {
            $permissioncount = DB::table('permissions')->where('permissionname','=',$name)->where('userid','=',$userid)->count();
            if($permissioncount>0)
            {
                Log::info('getUserPermissionByName Permission data found',array('data'=>$permissioncount));
                return json_encode(array('success'=>'true','data'=>$permissioncount,'error_code'=>'1003'));
            }
            else
            {
                Log::alert('getUserPermissionByName Permission data found',array('data'=>array('name'=>$name,'userid'=>$userid)));
                return json_encode(array('success'=>'false','data'=>'','error_code'=>'1004'));
            }
        }
    }
}
