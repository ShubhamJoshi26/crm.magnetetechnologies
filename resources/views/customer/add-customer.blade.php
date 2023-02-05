
@include('layout.header')
<?php

use App\Http\Controllers\UserController;
$id = Session()->get('id');
$permission = UserController::getUserPermissionByName('customers',$id);
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
<?php
include('layout.footer');
return false; }

?>
<!--start page wrapper -->
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
            <li class="breadcrumb-item active" aria-current="page">Add Client</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
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
      </div>
    </div>
    <!--end breadcrumb-->
    @include('layout.alert')
    <div class="card">
      <div class="card-body">
        <div class="bs-stepper-content">
          <form id="customerform" action="/CreateCustomer" method="post" enctype="multipart/form-data">
            <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
              <h5 class="mb-1">Personal Information</h5>
              <p class="mb-4">Enter personal information to get closer to our organization</p>
              <div class="row g-3">
                <div class="col-12 col-lg-6">
                  @csrf
                  <label for="FisrtName" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="FisrtName" placeholder="First Name" name="firstname">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="LastName" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="LastName" placeholder="Last Name" name="lastname">
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
                  <label for="InputCountry" class="form-label">Country</label>
                  <select class="form-select" id="InputCountry" aria-label="Default select example" name="country">
                    <option selected>--Select Country--</option>
                    <option value="1">India</option>
                    <option value="2">UK</option>
                    <option value="3">USA</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputCountry" class="form-label">Services</label>
                  <select class="form-select" id="InputService" aria-label="Default select example" name="service">
                    <option selected>--Select Services--</option>
                    <option value="CRM">CRM</option>
                    <option value="CMS">CMS</option>
                    <option value="BOTH">BOTH</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">Contcat Type</label>
                  <select class="form-select" id="InputLanguage" aria-label="Default select example" name="contacttype">
                    <option selected>--Select Customer Type--</option>
                    <option value="Online">Online</option>
                    <option value="Call">Call</option>
                    <option value="Mail">Mail</option>
                    <option value="Website">Website</option>
                    <option value="WhatsApp">WhatsApp</option>
                    <option value="Personal">Personal Visit</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">Client Category</label>
                  <select class="form-select" id="InputLanguage" aria-label="Default select example" name="clientcategory">
                    <option selected>--Select Client Category--</option>
                    <option value="Vender">Vender</option>
                    <option value="VIP">VIP</option>
                    <option value="Regular">Regular</option>
                    <option value="Personal">Personal</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">Payment Details</label>
                  <select class="form-select" id="InputLanguage" aria-label="Default select example" name="paymentdetails">
                    <option selected>--Select Payment Details--</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Online Transfer">Online Transfer</option>
                    <option value="Cheque">Cheque</option>
                    <option value="UPI">UPI</option>
                    <option value="DD">DD</option>
                  </select>
                </div>
                <div class="col-12 col-lg-12">
                  <label for="InputEmail" class="form-label">Full Address</label>
                  <textarea type="text" class="form-control" name="address" id="address" placeholder="Enter Full Address" name="fulladdress"></textarea>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">Status</label>
                  <select class="form-select" id="InputLanguage" aria-label="Default select example" name="status">
                    <option selected>--Select Status--</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    <option value="2">Hold</option>
                    <option value="3">Padding</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label for="InputLanguage" class="form-label">Upload Photo</label>
                  <input class="form-control" type="file" id="formFile" name="customer_photo">
                </div>
                <div class="col-12 col-lg-6">
                  <button class="btn btn-primary px-4" type="submit">Submit
                  </button>
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
<!--end page wrapper -->
@include('layout.footer')