@include('layout.header')
<?php

use App\Models\ticket;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TicketController;

$id = Session()->get('id');
$alltickets = ticket::getTicketsByUserId($id);
$ticketarr = json_decode($alltickets, true);
$inprocessticketcount = 0;
$newticketcount = 0;
$holdticketcount = 0;
$reopenticketcount = 0;
$closeticketcount = 0;
if($ticketarr['success']=='true')
{
    foreach($ticketarr['data'] as $ticketcounts)
    {
        if($ticketcounts['status']==1)
        {
            $newticketcount++;
            
        }
        else if($ticketcounts['status']==2)
        {
            $inprocessticketcount++;
        }
        else if($ticketcounts['status']==3)
        {
            $holdticketcount++;
        }
        else if($ticketcounts['status']==4)
        {
            $reopenticketcount++;
        }
        else if($ticketcounts['status']==5)
        {
            $closeticketcount++;
        }
    }
}
$permission = UserController::getUserPermissionByName('tickets', $id);
$permissionarr = json_decode($permission, true);
if ($permissionarr['success'] == 'false') { ?>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>You Are Not Authorized Person For This Module</strong>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>

        </div>
    </div>
<?php
    include('layout.footer');
    return false;
}

?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="getAllNewTicketsByUser(1);">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">New Tickets</p>
                                    <h4 class="my-1 text-info"><?php echo $newticketcount;?></h4>
                                    <!-- <p class="mb-0 font-13">+2.5% from last week</p> -->
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='fa fa-ticket'></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="getAllNewTicketsByUser(2);">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">In-Process</p>
                                <h4 class="my-1 text-danger"><?php echo $inprocessticketcount;?></h4>
                                <!-- <p class="mb-0 font-13">+5.4% from last week</p> -->
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='fa fa-file-text-o'></i>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="getAllNewTicketsByUser(4);">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Reopen</p>
                                <h4 class="my-1 text-success"><?php echo $reopenticketcount;?></h4>
                                <!-- <p class="mb-0 font-13">-4.5% from last week</p> -->
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='fa fa-exclamation-triangle'></i>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="getAllNewTicketsByUser(5);">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Closed</p>
                                <h4 class="my-1 text-warning"><?php echo $closeticketcount;?></h4>
                                <!-- <p class="mb-0 font-13">+8.4% from last week</p> -->
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='fa fa-ticket'></i>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="btn-group">
                    <a type="button" href='ticket/create' class="btn btn-primary">Create New Ticket</a>
                </div>
            </div>
        </div>
        @include('layout.alert')
        <div class="table-responsive">
            <table class="table table-striped table-bordered dataTable mt-3 text-center">
                <thead class="table-light">
                    <tr>
                        <th>Ticket Id</th>
                        <th>Priority</th>
                        <th>Ticket Name</th>
                        <th>Ticket Description</th>
                        <th>DeadLine Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tickettable">
                    <?php
                    if (isset($ticketarr['data']) && !empty($ticketarr['data'])) {
                        foreach ($ticketarr['data'] as $ticket) {
                            $assignedtoname = '';
                            $assignedbyname = '';
                            $assignedtoid = EmployeeController::getEmployeeById($ticket['assigned_to']);
                            $assignedto = json_decode($assignedtoid, true);
                            
                            if ($assignedto['success'] == 'true') {
                                $assignedtoname = $assignedto['data'][0]['name'];
                            }
                            $assignedbydata = UserController::getUserById($ticket['assigned_by']);
                            $assignedby = json_decode($assignedbydata, true);
                            if ($assignedby['success'] == 'true') {
                                $assignedbyname = $assignedby['data'][0]['name'];
                            }
                    ?>
                            <tr>
                                <td>{{$ticket['id']}}</td>
                                <td><?php if ($ticket['priority'] == 1) {
                                        echo "<span class='badge bg-success'>Low</span>";
                                    } elseif ($ticket['priority'] == 2) {
                                        echo "<span class='badge bg-warning text-dark'>Medium</span>";
                                    } elseif ($ticket['priority'] == 3) {
                                        echo "<span class='badge bg-danger'>High</span>";
                                    } ?></td>
                                <td>{{$ticket['taskname']}}</td>
                                <td>{{$ticket['description']}} <br><span style="float:left;" class='badge bg-info'><?php echo 'Assigned To: ' . $assignedtoname; ?></span><span style="float:right;" class='badge bg-primary'><?php echo 'Assigned By: ' . $assignedbyname; ?></span></td>
                                <td>{{date('d-m-Y',$ticket['deadline_date'])}}</td>
                                <td>
                                    <div class="d-flex order-actions justify-content-center">
                                        <a href="ticket/create?id={{$ticket['id']}}" class=""><i class="bx bxs-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="deleteTicket({{$ticket['id']}})" class="ms-3"><i class="bx bxs-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6">No Data Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layout.footer')