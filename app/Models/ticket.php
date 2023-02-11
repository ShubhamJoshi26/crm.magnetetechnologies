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
        
        if (array_key_exists('id', $data) && $data['id'] != '') {
            $ticket = ticket::find($data['id']);
            $ticket->updated_at =    $data['updated_at'];
        } else {
            $ticket = new ticket;
            $ticket->created_at =    $data['created_at'];
            $ticket->updated_at =    $data['updated_at'];
        }
        $ticket->taskname =    $data['taskname'];
        $ticket->description =    $data['description'];
        $ticket->status =    $data['status'];
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
        if($ticket->save())
        {
            if(isset($data['attachment']) && $data['attachment']!='')
            {
                $addattachment = DB::insert('INSERT INTO `ticketattachments` (`attachment`,`ticket_id`) VALUES ("'.$data['attachment'].'","'.$ticket->id.'")');
            }
            
                $comment = DB::insert('INSERT INTO `ticketcomments` (`ticket_id`,`commented_by`,`assigned_to`,`status`,`comment`,`created_at`,`updated_at`) VALUES ("'.$ticket->id.'","'.$ticket->assigned_by.'","'.$data['assigned_to'].'","'.$data['status'].'","'.$data['comment'].'","'.$ticket->created_at.'","'.$ticket->updated_at.'")');
            
            return true;
        }else{
            return false;
        }
        
    }
    public static function getTicketById($id)
    {
        $data = DB::select('select * from `tickets` where id = '.$id.'');
        return (array)$data[0];
    }
    public static function UpdateTicket($data)
    {
        $designation = designation::find($data['id']);
    }
    public static function deleteTicket($id)
    {
        DB::delete('DELETE FROM tickets WHERE id = ?', [$id]);
        return true;
    }
    public static function getTicketsByUserId($id)
    {
        $user_id = DB::table('users')->where('id','=',$id)->get('username');
        if($user_id[0]->username!='')
        {
            $userticket  = DB::table('tickets')->where('assigned_to','=',$user_id[0]->username)->get();
            
            if(!empty($userticket->toArray()))
            {
                return json_encode(array('success'=>'true','data'=>$userticket,'error_code'=>'10001'));
            }
            else
            {
                return json_encode(array('success'=>'false','data'=>'','error_code'=>'10002'));
            }
           
        }       
    }
    public static function getCommentByTickeyId($tid)
    {
        $comments = DB::table('ticketcomments')->where('ticket_id','=',$tid)->get();
        if(!empty($comments->toArray()))
        {
            return json_encode(array('success'=>'true','data'=>$comments,'error_code'=>'1003'));
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>'10004'));
        }
    }
}
