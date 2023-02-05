@include('layout.header')
<?php


use App\Http\Controllers\UserController;

$id = Session()->get('id');


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
              <h5 class="mb-1">Create Ticket</h5>
              <!-- <p class="mb-4">Enter personal information to get closer to our organization</p> -->
              <div class="row g-3">
                <div class="col-12 col-lg-6">
                  @csrf
                  <label for="taskname" class="form-label">Task Name</label>
                  <input type="text" class="form-control" id="taskname" placeholder="Task Name" name="taskname">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="description" class="form-label">Description</label>
                  <input type="text" class="form-control" id="description" placeholder="Description" name="description">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="ststus" class="form-label">Status</label>
                  <select type="text" class="form-control" id="ststus"  name="ststus" >
                    <option value="0">--Select Status--</option>
                    <option value="1">New</option>
                    <option value="2">In-Process</option>
                    <option value="3">Hold</option>
                    <option value="4">Reopen</option>
                    <option value="5">Close</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="priority" class="form-label">Priority</label>
                  <select type="text" class="form-control" id="priority"  name="priority" >
                    <option value="0">--Select Status--</option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">Heigh</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="assigned_to" class="form-label">Assigned To</label>
                  <select type="text" class="form-control" id="assigned_to" name="assigned_to">
                    <option value="0">--Select Assigned To--</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="from_date" class="form-label">From Date</label>
                  <input type="date" class="form-control datepicker" id="from_date" placeholder="From Date" name="from_date">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="deadline_date" class="form-label">DeadLine Date</label>
                  <input type="date" class="form-control" id="deadline_date" placeholder="DeadLine Date" name="deadline_date">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="assigned_date" class="form-label">Assigned Date</label>
                  <input type="date" class="form-control" id="assigned_date" placeholder="Assigned Date" name="assigned_date">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="category" class="form-label">Category</label>
                  <select class="form-select" id="category" aria-label="Default select example" name="category">
                    <option selected>--Select Category--</option>
                    <option value="1">L1</option>
                    <option value="2">Software Bug/Error</option>
                    <option value="3">New Requirment</option>
                    <option value="4">Online Training</option>
                    <option value="5">Impliment</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select" id="department" aria-label="Default select example" name="department">
                    <option value="0">--Select Department--</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="client" class="form-label">Client</label>
                  <select class="form-select" id="client" aria-label="Default select example" name="client">
                    <option selected>--Select Client Category--</option>
                    
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="contact_name" class="form-label">Contact Person</label>
                  <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Enter Contact Person Name">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="contact_number" class="form-label">Contact Number</label>
                  <input type="text" class="form-control" name="contact_number" maxlength="10" id="contact_number" placeholder="Enter Contact Number">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="contact_email" class="form-label">Contact Email Id</label>
                  <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="Enter Contact Email Id">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="attachment" class="form-label">attachment</label>
                  <input class="form-control" type="file" id="attachment" name="attachment">
                </div>
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