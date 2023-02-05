<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ticket extends Model
{
    use HasFactory;
    public $timestamps = false;
    public static function getAllTickets()
    {
        $data = DB::select('Select * from `tickets`');
        return json_encode(array('success'=>'true','data'=>$data,'error_code'=>'10001'));
    }
    public static function CreateTicket($data)
    {
        $ticket = new ticket;
        $ticket->taskname =    $data['taskname'];
        $ticket->description =    $data['description'];
        $ticket->ststus =    $data['ststus'];
        $ticket->priority =    $data['priority'];
        $ticket->assigned_to =    $data['assigned_to'];
        $ticket->from_date =    $data['from_date'];
        $ticket->deadline_date =    $data['deadline_date'];
        $ticket->assigned_date =    $data['assigned_date'];
        $ticket->assigned_by =    $data['assigned_by'];
        $ticket->category =    $data['category'];
        $ticket->department =    $data['department'];
        $ticket->client =    $data['client'];
        $ticket->contact_name =    $data['contact_name'];
        $ticket->contact_number =    $data['contact_number'];
        $ticket->contact_email =    $data['contact_email'];
        $ticket->attachment =    $data['attachment'];
        $ticket->created_at =    $data['created_at'];
        $ticket->updated_at =    $data['updated_at'];
        if($ticket->save())
        {
            return true;
        }else{
            return false;
        }
    }
}
