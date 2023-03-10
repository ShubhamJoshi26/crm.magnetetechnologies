@include('layout.header')
<?php


use App\Http\Controllers\UserController;
use App\Models\employee;
use App\Models\department;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TicketController;
use App\Models\ticket;

$id = Session()->get('id');
$selectedcheck = '';
$allemployees = employee::getActiveRecords();
$employees = json_decode($allemployees, true);
if ($employees['success'] == 'true') {

  $empopt = '<option value="0">--Select Assigned To--</option>';
  foreach ($employees['data'] as $emp) {
    $selectedcheck = '';
    if (isset($ticketdata) && !empty($ticketdata)) {
      if ($ticketdata['assigned_to'] == $emp['employee_id']) {
        $selectedcheck = 'selected="selected"';
      }
    }
    $empopt .= '<option value=' . $emp['employee_id'] . ' ' . $selectedcheck . ' >' . $emp['name'] . '</option>';
  }
}
$departArr = department::getRecords();
$departments = json_decode($departArr, true);
$depopt = '<option value="0">--Select Department--</option>';
foreach ($departments['data'] as $department) {
  $selectedcheck = '';
  if ($department['status'] == 1) {
    if (isset($ticketdata) && !empty($ticketdata)) {
      if ($ticketdata['department'] == $department['id']) {
        $selectedcheck = 'selected="selected"';
      }
    }
    $depopt .= '<option value=' . $department['id'] . ' ' . $selectedcheck . '>' . $department['name'] . '</option>';
  }
}
$customers = CustomerController::getCustomerList();
$customerarr = json_decode($customers, true);
$clientopt = '<option value="0">--Select Client--</option>';
if ($customerarr['success'] == 'true') {
  foreach ($customerarr['data'] as $customer) {
    $selectedcheck = '';
    if ($customer['status'] == 1) {
      if (isset($ticketdata) && !empty($ticketdata)) {
        if ($ticketdata['client'] == $customer['customerid']) {
          $selectedcheck = 'selected="selected"';
        }
      }
      $clientopt .= '<option value=' . $customer['customerid'] . ' ' . $selectedcheck . '>' . $customer['firstname'] . ' ' . $customer['lastname'] . '</option>';
    }
  }
}
if (isset($ticketdata) && !empty($ticketdata)) {
  $TicketAttachments = TicketController::getAttachmentsByTicketId($ticketdata['id']);
  $allattachments = json_decode($TicketAttachments, true);
  if (isset($allattachments['data']) && !empty($allattachments['data'])) {
    $attachmentsarr = $allattachments['data'];
  }
}
if (isset($ticketdata) && !empty($ticketdata)) {
$allcomments = ticket::getCommentByTickeyId($ticketdata['id']);
$commentarr = json_decode($allcomments,true);
if($commentarr['success']=='true')
{
  $comments = $commentarr['data'];
}
}
function getStatus($status)
{
  if(!is_null($status))
  {
    $statusname = match($status)
    {
      '1'=>'New',
      '2'=>'In-Process',
      '3'=>'Hold',
      '4'=>'Reopen',
      '5'=>'Close',
    };
    return $statusname;
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
    @include('layout.alert')
    <div class="card">
      <div class="card-body">
        <div class="bs-stepper-content">
          <form id="ticketform" action="create" method="post" enctype="multipart/form-data">
            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
              <h5 class="mb-1">Create Ticket- <?php if(isset($ticketdata) && !empty($ticketdata)){ echo $ticketdata['id'];}?></h5>
              <!-- <p class="mb-4">Enter personal information to get closer to our organization</p> -->
              <div class="row g-3">
                <div class="col-12 col-lg-6">
                  @csrf
                  <input type="hidden" name="id" id="id" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['id'] != '') {
                                                                  echo $ticketdata['id'];
                                                                } ?>">
                  <label for="taskname" class="form-label">Task Name</label>
                  <input type="text" class="form-control" id="taskname" placeholder="Task Name" name="taskname" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['taskname'] != '') {
                                                                                                                          echo $ticketdata['taskname'];
                                                                                                                        } ?>">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="description" class="form-label">Description</label>
                  <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['description'] != '') {
                                                                                                                                  echo $ticketdata['description'];
                                                                                                                                } ?>">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="status" class="form-label">Status</label>
                  <select type="text" class="form-control" id="status" name="status">
                    <option value="0">--Select Status--</option>
                    <option value="1" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['status'] == "1") {
                                        echo 'selected';
                                      } ?>>New</option>
                    <option value="2" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['status'] == "2") {
                                        echo 'selected';
                                      } ?>>In-Process</option>
                    <option value="3" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['status'] == "3") {
                                        echo 'selected';
                                      } ?>>Hold</option>
                    <option value="4" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['status'] == "4") {
                                        echo 'selected';
                                      } ?>>Reopen</option>
                    <option value="5" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['status'] == "5") {
                                        echo 'selected';
                                      } ?>>Close</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="priority" class="form-label">Priority</label>
                  <select type="text" class="form-control" id="priority" name="priority">
                    <option value="0">--Select Status--</option>
                    <option value="1" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['priority'] == "1") {
                                        echo 'selected';
                                      } ?>>Low</option>
                    <option value="2" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['priority'] == "2") {
                                        echo 'selected';
                                      } ?>>Medium</option>
                    <option value="3" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['priority'] == "3") {
                                        echo 'selected';
                                      } ?>>High</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="assigned_to" class="form-label">Assigned To</label>
                  <select type="text" class="form-control" id="assigned_to" name="assigned_to">
                    <?php echo $empopt; ?>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="from_date" class="form-label">From Date</label>
                  <input type="text" class="form-control datepicker" id="from_date" placeholder="From Date" name="from_date" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['from_date'] != '') {
                                                                                                                                      echo date('d-m-Y', $ticketdata['from_date']);
                                                                                                                                    } ?>">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="deadline_date" class="form-label">DeadLine Date</label>
                  <input type="text" class="form-control datepicker" id="deadline_date" placeholder="DeadLine Date" name="deadline_date" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['deadline_date'] != '') {
                                                                                                                                                  echo date('d-m-Y', $ticketdata['deadline_date']);
                                                                                                                                                } ?>">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="assigned_date" class="form-label">Assigned Date</label>
                  <input type="text" class="form-control datepicker" id="assigned_date" placeholder="Assigned Date" name="assigned_date" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['assigned_date'] != '') {
                                                                                                                                                  echo date('d-m-Y', $ticketdata['assigned_date']);
                                                                                                                                                } ?>">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="category" class="form-label">Category</label>
                  <select class="form-select" id="category" aria-label="Default select example" name="category">
                    <option selected>--Select Category--</option>
                    <option value="1" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['category'] == "1") {
                                        echo 'selected';
                                      } ?>>L1</option>
                    <option value="2" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['category'] == "2") {
                                        echo 'selected';
                                      } ?>>Software Bug/Error</option>
                    <option value="3" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['category'] == "3") {
                                        echo 'selected';
                                      } ?>>New Requirment</option>
                    <option value="4" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['category'] == "4") {
                                        echo 'selected';
                                      } ?>>Online Training</option>
                    <option value="5" <?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['category'] == "5") {
                                        echo 'selected';
                                      } ?>>Impliment</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select" id="department" aria-label="Default select example" name="department">
                    <?php echo $depopt; ?>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="client" class="form-label">Client</label>
                  <select class="form-select" id="client" aria-label="Default select example" name="client">
                    <?php echo $clientopt; ?>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="contact_name" class="form-label">Contact Person</label>
                  <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Enter Contact Person Name" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['contact_name'] != '') {
                                                                                                                                                  echo $ticketdata['contact_name'];
                                                                                                                                                } ?>">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="contact_number" class="form-label">Contact Number</label>
                  <input type="number" class="form-control" name="contact_number" maxlength="10" id="contact_number" placeholder="Enter Contact Number" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['contact_number'] != '') {
                                                                                                                                                                  echo $ticketdata['contact_number'];
                                                                                                                                                                } ?>">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="contact_email" class="form-label">Contact Email Id</label>
                  <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="Enter Contact Email Id" value="<?php if (isset($ticketdata) && !empty($ticketdata) && $ticketdata['contact_email'] != '') {
                                                                                                                                                echo $ticketdata['contact_email'];
                                                                                                                                              } ?>">
                </div>
                <div class="col-12 col-lg-12">
                  <label for="attachment" class="form-label">Comment</label>
                  <textarea class="form-control" type="text" id="comment" name="comment"></textarea>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="attachment" class="form-label">attachment</label>
                  <input class="form-control" type="file" id="attachment" name="attachment">
                </div>
                <div class="col-12 col-lg-6">
                  <!-- <label for="" class="form-label">Attachments</label> -->
                  <ul style="list-style: none;">
                    <?php
                    if (isset($attachmentsarr) && !empty($attachmentsarr)) {
                      foreach ($attachmentsarr as $attachment) {
                    ?>
                        <li><a download href="<?php echo URL::asset($attachment['attachment']); ?>"><?php $atname = explode('/', $attachment['attachment']); echo end($atname); ?></a></li>
                    <?php
                      }
                    }
                    ?>
                  </ul>
                </div>
              </div>
              <div class="table-responsive">
            <table class="table table-striped table-bordered dataTable mt-3 text-center">
                <thead class="table-light">
                    <tr>
                        <th>Comment</th>
                        <th>Commented By</th>
                        <th>Assigned To</th>
                        <th>Date/Time</th>
                        <th>Status</th>
                       
                        
                    </tr>
                </thead>
                <tbody id="tickettable">
                    <?php
                    if (isset($comments) && !empty($comments)) {
                        foreach ($comments as $key=> $carr) {
                            $assignedbyname = '';
                            $assignedtoname = '';
                            $assignedtoid = EmployeeController::getEmployeeById($carr['assigned_to']);
                            $assignedto = json_decode($assignedtoid, true);
                            if ($assignedto['success'] == 'true' && !empty($assignedto['data'])) {
                                $assignedtoname = $assignedto['data'][0]['name'];
                            }
                            $assignedbydata = UserController::getUserById($carr['commented_by']);
                            $assignedby = json_decode($assignedbydata, true);
                            if ($assignedby['success'] == 'true') {
                                $assignedbyname = $assignedby['data'][0]['name'];
                            }
                            // echo ($carr['status']);die('ddd');
                    ?>
                            <tr>
                                <td><?php echo $carr['comment'];?></td>
                                <td><?php echo $assignedbyname;?></td>
                                <td><?php echo $assignedtoname;?></td>
                                <td><?php echo $carr['created_at'];?></td>
                                <td><?php if($carr['status']!='' && $carr!=NULL){if($key>0 && $comments[$key-1]['status']!=$carr['status'] ){ echo getStatus($comments[$key-1]['status']).' to ';};  echo getStatus($carr['status']);} ?></td>
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
              <div class="row mt-5">
                <div class="col-5">

                </div>
                <div class="col-12 col-lg-2">
                  <button class="btn btn-primary px-4" type="submit">Submit
                  </button>
                </div>
                <div class="col-5">

                </div>
              </div>
              <!---end row-->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>






@include('layout.footer')