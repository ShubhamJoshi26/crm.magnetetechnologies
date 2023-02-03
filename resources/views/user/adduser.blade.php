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

?>
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Applications</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item">
              <a href="javascript:;">
                <i class="bx bx-home-alt"></i>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
          </ol>
        </nav>
      </div>
      <!-- <div class="ms-auto">
        <div class="btn-group">
          <button type="button" class="btn btn-primary">Settings</button>
          <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
            <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
            <a class="dropdown-item" href="javascript:;">Action</a>
            <a class="dropdown-item" href="javascript:;">Another action</a>
            <a class="dropdown-item" href="javascript:;">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:;">Separated link</a>
          </div>
        </div>
      </div> -->
    </div>
    <!--end breadcrumb-->
    @include('layout.alert')
    <div class="card">
      <div class="card-body">
        <div class="bs-stepper-content">
          <form id="userform" action="/CreateUser" method="post" enctype="multipart/form-data">
            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
              <h5 class="mb-1">Personal Information</h5>
              <p class="mb-4">Enter personal information to get closer to our organization</p>
              <div class="row g-3">
                <div class="col-12 col-lg-6">
                  @csrf
                  <label for="FisrtName" class="form-label">User Name</label>
                  <input type="text" class="form-control" id="FisrtName" placeholder="First Name" name="name">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="PhoneNumber" class="form-label">Phone Number</label>
                  <input type="text" class="form-control" id="PhoneNumber" placeholder="Phone Number" name="mobile">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputEmail" class="form-label">E-mail Address</label>
                  <input type="text" class="form-control" id="InputEmail" placeholder="Enter Email Address" name="email">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputCountry" class="form-label">Designation</label>
                  <input type="text" class="form-control" placeholder="Enter Designation" id="InputDesignation" aria-label="Default select example" name="designation">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">User Type</label>
                  <select class="form-select" id="InputLanguage" aria-label="Default select example" name="usertype">
                    <option selected>--Select Type--</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">Status</label>
                  <select class="form-select" id="InputLanguage" aria-label="Default select example" name="status">
                    <option selected>--Select Status--</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="hold">Hold</option>
                    <option value="pending">Pending</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputCountry" class="form-label">Create Password</label>
                  <input type="text" class="form-control" placeholder="Enter Password" id="InputPassword" aria-label="Default select example" name="password">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">Upload Photo</label>
                  <input class="form-control" type="file" id="formFile" name="user_photo">
                </div>
                <div class="col-12 col-lg-12">
                  <label for="InputEmail" class="form-label">Full Address</label>
                  <textarea type="text" class="form-control" name="address" id="address" placeholder="Enter Full Address" name="fulladdress"></textarea>
                </div>
                <div class="col-12 col-lg-6">
                  <button class="btn btn-primary px-4" type="submit">Submit
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





@include('layout.footer')