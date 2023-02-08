<?php

namespace App\Http\Controllers;

use App\Models\ticketsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public static function CreateTicketSettings(Request $data)
    {
        $setting['prefix'] = $data->prefix;
        $setting['saperator'] = $data->saperator;
        $setting['lastnumber'] = $data->lastnumber;
        if($data->id!='')
        {
            $setting['id'] = $data->id;
            $result = ticketsetting::CreateTicketSettings($setting);
        }
        else
        {
            $result = ticketsetting::CreateTicketSettings($setting);
        }
        if($result)
            {
                return redirect('ticket')->with('success','Ticket Generation Number Created Successfully');
            }
            else
            {
                return redirect('ticket')->with('error','Setting Not Created');
            }
    }
    public static function getTicketLastNumber()
    {
        $number = DB::table('ticketsettings')->get('lastnumber');
        return $number;
    }
}
