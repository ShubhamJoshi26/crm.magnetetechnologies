<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

$action = $_REQUEST['action'];
if(!empty($_REQUEST) && $action=='getTicket')
{
    $status = $_REQUEST['sts'];
    $newtickets = TicketController::getTicketByStatus($status);
    $allnewtickets = json_decode($newtickets,true);
   if($allnewtickets['success']=='true')
   {
    foreach($allnewtickets['data'] as $ticket)
    {   
        $assignedtoname = '';
        $assignedbyname = '';
        $assignedtoid = EmployeeController::getEmployeeById($ticket['assigned_to']);
        $assignedto = json_decode($assignedtoid,true);
        if($assignedto['success']=='true')
        {
            $assignedtoname = $assignedto['data'][0]['name'];
        }
        $assignedbydata = UserController::getUserById($ticket['assigned_by']);
        $assignedby = json_decode($assignedbydata,true);
        if($assignedby['success']=='true')
        {
            $assignedbyname = $assignedby['data'][0]['name'];
        }
        ?>
            <tr>
                                <td>{{$ticket['id']}}</td>
                                <td><?php if($ticket['priority']==1){ echo "<span class='badge bg-success'>Low</span>";}elseif($ticket['priority']==2){echo "<span class='badge bg-warning text-dark'>Medium</span>";}elseif($ticket['priority']==3){echo "<span class='badge bg-danger'>Heigh</span>";}?></td>
                                <td>{{$ticket['taskname']}}</td>
                                <td>{{$ticket['description']}} <br><span style="float:left;" class='badge bg-info'><?php echo 'Assigned To: '.$assignedtoname;?></span><span style="float:right;" class='badge bg-primary'><?php echo 'Assigned By: '.$assignedbyname;?></span> </td>
                                <td>{{$ticket['deadline_date']}}</td>
                                <td><div class="d-flex order-actions justify-content-center">
												<a href="ticket/create?id={{$ticket['id']}}" class=""><i class="bx bxs-edit"></i></a>
												<a href="javascript:void(0);" onclick="deleteTicket({{$ticket['id']}})" class="ms-3"><i class="bx bxs-trash"></i></a>
											</div></td>
                            </tr>
        <?php
    }
   }
}

?>