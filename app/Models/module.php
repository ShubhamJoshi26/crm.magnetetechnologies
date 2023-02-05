<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class module extends Model
{
    use HasFactory;
    public $table = 'module';
    protected  $primaryKey = 'moduleid';

    public static function getRecords()
    {
        $data = module::all()->toArray();
        return $data;
    }

    public static function saveRecord($data)
    {
        if (array_key_exists('moduleid', $data) && $data['moduleid'] != '') {
            $module = module::find($data['moduleid']);
        } else {
            $module = new module;
        }
            $module->modulename = $data['modulename'];
            if ($module->save()) {
                return true;
            } else {
                return false;
            }
    }

    public static function getDataById($id)
    {
        $data = DB::select('select * from `module` where moduleid=' . $id);
        return $data;
    }
    public static function destroy($id)
    {
        DB::delete('DELETE FROM module WHERE moduleid = ?', [$id]);
        return true;
    }
}
