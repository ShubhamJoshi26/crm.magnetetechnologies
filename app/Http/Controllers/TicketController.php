<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ticket;
use Illuminate\Support\Facades\DB;
class TicketController extends Controller
{
    public static function create(Request $request)
    {
        $ticketlastnumber = SettingsController::getTicketLastNumber();
        if($request->isMethod('get'))
        {
            if($request->id!='')
            {
                $ticketdata = ticket::getTicketById($request->id);
                $data = $ticketdata;
                return view('ticket/addticket',['ticketdata'=>$data]);
            }
            return view('ticket/addticket');
        }
        if($request->isMethod('post'))
        {
            $data['taskname'] = $request->taskname;
            $data['description'] = $request->description;
            $data['status'] = $request->status;
            $data['priority'] = $request->priority;
            $data['assigned_to'] = $request->assigned_to;
            $data['from_date'] = strtotime($request->from_date);
            $data['deadline_date'] = strtotime($request->deadline_date);
            $data['assigned_date'] = strtotime($request->assigned_date);
            $data['assigned_by'] = Session()->get('id');
            $data['category'] = $request->category;
            $data['department'] = $request->department;
            $data['client'] = $request->client;
            $data['contact_name'] = $request->contact_name;
            $data['contact_number'] = $request->contact_number;
            $data['contact_email'] = $request->contact_email;
            $data['attachment'] = $request->attachment;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            if (!empty($_FILES) && $_FILES['attachment']['name'] != '') 
            {
                $imageName = time().$_FILES['attachment']['name'].'.' . $request->attachment->extension();
                $request->attachment->move(public_path('uploads/ticket/attachment'), $imageName);
                $ticketattachmentpath = 'uploads/ticket/attachment/'.$imageName;
                $data['attachment'] = $ticketattachmentpath;
            }
            if($request->id !='')
            {
                $data['id'] = $request->id;
                $result = ticket::CreateTicket($data);
            }
            else
            {
                $result = ticket::CreateTicket($data);
            }
            if($result)
            {
                return redirect('ticket')->with('success','Ticket Created Succesfully');
            }
            else
            {
                return redirect('ticket')->with('error','Ticket Not Created');
            }
        }
    }
    public static function Delete(Request $request)
    {
        $result = ticket::deleteTicket($request->id);
        if ($result) {
            echo ("Employee deleted successfully.");
        } else {
            echo 'Something went wrong';
        }
    }
    public static function getTicketByStatus($status)
    {
        $ticketdata = DB::table('tickets')->where('status','=',$status)->get();
        return json_encode(array('success'=>'true','data'=>$ticketdata,'error_code'=>'10001'));
    }
    public static function getAttachmentsByTicketId($id)
    {
        $attachments = DB::table('ticketattachments')->where('ticket_id','=',$id)->get();
        return json_encode(array('success'=>'true','data'=>$attachments,'error_code'=>'10001'));
    }
}
