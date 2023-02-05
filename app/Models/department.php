<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class department extends Model
{
    use HasFactory;

    public $timestamps = false;
    public static function getRecords()
    {
        $data = DB::select('Select * from `departments`');
        return json_encode(array('success'=>'true','data'=>$data,'error_code'=>'10001'));
    }
    public static function getDepartmentDropdown()
    {
        $data = DB::select('Select * from `departments` where status="1"');
        return $data;
    }

    
    public static function saveRecord($data)
    {
        $department = new department;
        $department->name = $data['name'];
        $department->status = $data['status'];
        $department->addedon = date('now');
        if($department->save())
        {
            return true;
        }else{
            return false;
        }
    }
    public static function updateRecord($data)
    {
        $department = department::find($data['id']);
        $department->name = $data['name'];
        $department->status = $data['status'];
        if($department->save())
        {
            return true;
        }else{
            return false;
        }
    }

    public static function getDataById($id)
    {
        $data = department::find($id);
        return $data;
    }
    public static function destroy($id) 
    {
       DB::delete('DELETE FROM departments WHERE id = ?', [$id]);
       return true;
    }

}
