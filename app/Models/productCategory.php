<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class productCategory extends Model
{
    use HasFactory;
    public $table = 'product_category';

    public static function getRecords()
    {
        $data = productCategory::all()->toArray();
        return $data;
    }

    public static function saveRecord($data)
    {
        if (array_key_exists('id', $data) && $data['id'] != '') {
            $productCategory = productCategory::find($data['id']);
        } else {
            $productCategory = new productCategory;
        }
            $productCategory->name = $data['name'];
            if ($productCategory->save()) {
                return true;
            } else {
                return false;
            }
    }

    public static function getCategoryDropdown()
    {
        $data = DB::select('Select * from `product_category`');
        return $data;
    }

    public static function getDataById($id)
    {
        $data = DB::select('select * from `product_category` where id=' . $id);
        return $data;
    }
    public static function destroy($id)
    {
        DB::delete('DELETE FROM product_category WHERE id = ?', [$id]);
        return true;
    }
}
