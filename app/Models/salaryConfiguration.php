<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class salaryConfiguration extends Model
{
    use HasFactory;
    public $table = 'salary';
    public $primaryKey = 'employee_id';


    public static function saveRecord($data)
    {
        
        $salaryConfiguration = salaryConfiguration::find($data['employee_id']);
        // echo '<pre>'; print_r($data); die;
        if(empty($salaryConfiguration)){
            $salaryConfiguration = new salaryConfiguration;
            $salaryConfiguration->employee_id = $data['employee_id'];
        }
            
        $salaryConfiguration->ctc = $data['total_ctc'];
        
        if ($salaryConfiguration->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getDataById($id)
    {
        $data = DB::select('select * from `salary` where id=' . $id);
        return $data;
    }
   
    public static function getDataByEmployeeId($id)
    {
        $data = DB::select('select * from `salary` where employee_id=' . $id);
        return $data;
    }
    public static function destroy($id)
    {
        DB::delete('DELETE FROM salary WHERE id = ?', [$id]);
        return true;
    }
}
