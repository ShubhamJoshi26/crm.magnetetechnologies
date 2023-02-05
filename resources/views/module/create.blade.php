
@include('layout.header')
<?php

use App\Http\Controllers\UserController;
$id = Session()->get('id');
$permission = UserController::getUserPermissionByName('user',$id);
$permissionarr = json_decode($permission, true);

if($permissionarr['success']=='false')
{?>
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>You Are Not Authorized Person For This Module</strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
        
    </div>
</div>
<?php  return false; }
// echo '<pre>'; print_r($data); die;

?>
<!--start page wrapper -->
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Module</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item">
              <a href="javascript:;">
                <i class="bx bx-home-alt"></i>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Module</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    @include('layout.alert')
    <div class="card">
      <div class="card-body">
        <div class="bs-stepper-content">
          <form id="moduleform" action="" method="post">
            <?php if(!empty($data) && !empty($data->moduleid)){ ?>
                <input type='hidden' name='moduleid' value='{{$data->moduleid}}'/>
                <?php } ?>
            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
              <h5 class="mb-1">Module Information</h5>
              <div class="row g-3">
                <div class="col-12 col-lg-6">
                  @csrf
                  <label for="FisrtName" class="form-label">Name</label>
                  <input type="text" required class="form-control" id="modulename" value="<?php if(!empty($data) && !empty($data->modulename)){ echo $data->modulename; } ?>" placeholder="Module Name" name="modulename">
                </div>
                
                <div class="col-12 col-lg-12">
                  <button class="btn btn-primary px-4" type="submit">Save
                  </button>
                </div>
              </div>
              <!---end row-->
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end page wrapper -->
@include('layout.footer')