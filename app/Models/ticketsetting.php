<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticketsetting extends Model
{
    use HasFactory;
    public $timestemps = false;
    public static function CreateTicketSettings($data)
    {
        if (array_key_exists('id', $data) && $data['id'] != '') {
            $setting = ticketsetting::find($data['id']);
            $setting->updated_at = date('m-d-Y H:i:s');
        } else {
            $setting = new ticketsetting;
            $setting->created_at = date('m-d-Y H:i:s');
        }
        $setting->prefix = $data['prefix'];
        $setting->saperator = $data['saperator'];
        $setting->lastnumber = $data['lastnumber'];
        if($setting->save())
        {
            return true;
        }else{
            return false;
        }
    }
}
