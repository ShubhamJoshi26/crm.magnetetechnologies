<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class employee extends Model
{
    use HasFactory;

    public $timestamps = false;
    public static function getRecords()
    {
        $data = DB::select('Select * from `employees`');
        return json_encode(array('success' => 'true', 'data' => $data, 'error_code' => '10001'));
    }
    public static function getActiveRecords()
    {
        $data = DB::select('Select * from `employees` where `status`=1');
        return json_encode(array('success' => 'true', 'data' => $data, 'error_code' => '10001'));
    }

    public static function saveRecord($data)
    {
        if (array_key_exists('id', $data) && $data['id'] != '') {
            $employee = employee::find($data['id']);
            $userModel = User::find($data['user_id']);
        } else {
            $employee = new employee;
            $userModel = new User;
        }

        $userModel->name = $data['name'];
        $userModel->email = $data['email'];
        $userModel->username = $data['employee_id'];
        $userModel->usertype = 'employee';
        $userModel->password = md5($data['password']);

        if ($userModel->save()) {
            $employee->user_id = $userModel->id;
            $employee->employee_id = $data['employee_id'];
            $employee->name = $data['name'];
            $employee->fathername = $data['fathername'];
            $employee->address = $data['address'];
            $employee->email = $data['email'];
            $employee->phone = $data['phone'];
            $employee->designation_id = $data['designation_id'];
            $employee->department_id = $data['department_id'];
            $employee->profile = $data['profile'];
            $employee->status = $data['status'];


            if (!empty($data['profile_photo'])) {
                $employee->profile_photo = $data['profile_photo'];
            }
            if ($employee->save()) {
                return true;
            } else {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public static function getDataById($id)
    {
        $data = employee::find($id);
        return $data;
    }
    public static function destroy($id)
    {
        DB::delete('DELETE FROM employees WHERE id = ?', [$id]);
        return true;
    }

}