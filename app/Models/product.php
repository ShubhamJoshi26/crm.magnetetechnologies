<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class product extends Model
{
    use HasFactory;
    public $table = 'products';
    public $timestamps = true;

    public static function getRecords()
    {
        $data = product::all()->toArray();
        return $data;
    }

    public static function saveRecord($data)
    {
        if (array_key_exists('id', $data) && $data['id'] != '') {
            $product = product::find($data['id']);
        } else {
            $product = new product;
        }
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->status = $data['status'];
            $product->category_id = $data['category_id'];
            if ($product->save()) {
                return true;
            } else {
                return false;
            }
    }

    public static function getDataById($id)
    {
        $data = DB::select('select * from `products` where id=' . $id);
        return $data;
    }
    public static function destroy($id)
    {
        DB::delete('DELETE FROM products WHERE id = ?', [$id]);
        return true;
    }
}
