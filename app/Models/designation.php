<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class designation extends Model
{
    use HasFactory;

    public $timestamps = false;
    public static function getRecords()
    {
        $data = DB::select('Select * from `designations`');
        return json_encode(array('success'=>'true','data'=>$data,'error_code'=>'10001'));
    }
    
    public static function saveRecord($data)
    {
        $designation = new designation;
        $designation->name = $data['name'];
        $designation->status = $data['status'];
        // $designation->created_at = date('now');
        if($designation->save())
        {
            return true;
        }else{
            return false;
        }
    }
    public static function updateRecord($data)
    {
        $designation = designation::find($data['id']);
        $designation->name = $data['name'];
        $designation->status = $data['status'];
        if($designation->save())
        {
            return true;
        }else{
            return false;
        }
    }

    public static function getDataById($id)
    {
        $data = designation::find($id);
        return $data;
    }
    public static function destroy($id) 
    {
       DB::delete('DELETE FROM designations WHERE id = ?', [$id]);
       return true;
    }

}
