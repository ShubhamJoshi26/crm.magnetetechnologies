
@include('layout.header')
<?php

use App\Http\Controllers\UserController;
use App\Models\designation;
use App\Models\department;
$id = Session()->get('id');
$permission = UserController::getUserPermissionByName('employee',$id);
$permissionarr = json_decode($permission, true);
$desigArr = designation::getDesignationDropdown();
$departArr = department::getDepartmentDropdown();
// print_r($desigArr); die;
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
      <div class="breadcrumb-title pe-3">Employee</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item">
              <a href="javascript:;">
                <i class="bx bx-home-alt"></i>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    @include('layout.alert')
    <div class="card">
      <div class="card-body">
        <div class="bs-stepper-content">
          <form id="employeeform" action="" method="post" enctype="multipart/form-data">
            <?php if(!empty($data) && !empty($data['id'])){ ?>
                <input type='hidden' name='id' value='{{$data["id"]}}'/>
                <input type='hidden' name='user_id' value='{{$data["user_id"]}}'/>
                <?php } ?>
            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
              <h5 class="mb-1">Employee Information</h5>
              <div class="row g-3">
              @csrf

                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Emp Id *</label>
                  <input type="text" required class="form-control" id="employee_id" 
                  value="<?php if(!empty($data) && !empty($data['employee_id'])){ echo $data['employee_id']; } ?>" 
                  placeholder="Employee Id" name="employee_id">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Name *</label>
                  <input type="text" required class="form-control" id="Name" value="<?php if(!empty($data) && !empty($data['name'])){ echo $data['name']; } ?>" placeholder="Name" name="name">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Father Name *</label>
                  <input type="text" required class="form-control" id="fathername" value="<?php if(!empty($data) && !empty($data['fathername'])){ echo $data['fathername']; } ?>" placeholder="Father Name" name="fathername">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Address *</label>
                  <input type="text" required class="form-control" id="address" 
                  value="<?php if(!empty($data) && !empty($data['address'])){ echo $data['address']; } ?>" placeholder="Address" 
                  name="address">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Email *</label>
                  <input type="email" required class="form-control" id="email" 
                  value="<?php if(!empty($data) && !empty($data['email'])){ echo $data['email']; } ?>" placeholder="Email" 
                  name="email">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Phone No *</label>
                  <input type="number" required class="form-control" id="phone" 
                  value="<?php if(!empty($data) && !empty($data['phone'])){ echo $data['phone']; } ?>" placeholder="Phone No" 
                  name="phone">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Designation *</label>
                  <select required class="form-control" id="designation_id" name="designation_id">
                    <option value=''>Select</option>
                    <?php foreach($desigArr as $designation): ?>
                      <option <?php if(!empty($data) && $data['designation_id']==$designation->id){ echo 'selected';}?> value='<?=$designation->id?>'><?=$designation->name?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Department *</label>
                  <select required class="form-control" id="department_id" name="department_id">
                    <option value=''>Select</option>
                    <?php foreach($departArr as $department): ?>
                      <option <?php if(!empty($data) && $data['department_id']==$department->id){ echo 'selected';}?> value='<?=$department->id?>'><?=$department->name?></option>
                      <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Profile Bio *</label>
                  <input type="text" required class="form-control" id="profile" 
                  value="<?php if(!empty($data) && !empty($data['profile'])){ echo $data['profile']; } ?>" placeholder="Profile Bio" 
                  name="profile">
                 
                </div>
                
                
             
                <div class="col-12 col-lg-6">
                  <label for="InputStatus" class="form-label">Status *</label>
                  <select class="form-select" required id="InputStatus" aria-label="Default select example" name="status">
                    <option value='' >--Select--</option>
                    <option <?php if(!empty($data) && $data['status']==1){ echo 'selected';}?> value="1">Active</option>
                    <option <?php if(!empty($data) && $data['status']==0){ echo 'selected';}?> value="0">In-Active</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Profile Photo *</label>
                  <input type="file" <?php if(empty($data['profile_photo'])){ echo 'required'; } ?>  class="form-control" id="profile_photo" name="profile_photo">
                  <?=(!empty($data['profile_photo'])?'<p>('.$data['profile_photo'].')</p>':'')?>
                </div>

                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Password *</label>
                  <input type="password" required class="form-control" id="password" 
                  value="<?php if(!empty($userData) && !empty($userData['password'])){ echo $userData['password']; } ?>" placeholder="Password" 
                  name="password">
                 
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