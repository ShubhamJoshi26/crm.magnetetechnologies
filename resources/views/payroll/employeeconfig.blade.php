@include('layout.header')
<?php

use App\Http\Controllers\UserController;
use App\Models\employee;
use App\Models\User;

$id = Session()->get('id');
$permission = UserController::getUserPermissionByName('employee',$id);
$permissionarr = json_decode($permission, true);
if($permissionarr['success']=='false')
{?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>You Are Not Authorized Person For This Module</strong>
        </div>
    </div>
</div>
<?php  return false; }

?>
<?php
$employeeList = employee::getRecords();
$employees = json_decode($employeeList,true);
// print_r($employees); die;

?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Payroll</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Employees Configuration</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
        <!-- <div class="btn-group">
          <a type="button" href='employee/create' class="btn btn-primary">Add New</a>
          
        </div> -->
      </div>
        </div>
        <!--end breadcrumb-->
        @include('layout.alert')
        <!-- Listing code start -->

        <div class="card radius-10">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($employees['data']) && !empty($employees['data']))
                                {
                                    foreach($employees['data'] as $employee)
                                    {
                                        $userpermission = array();
                                        $userpermissions = UserController::getUserPermissions($employee['id']);
                                        $userData = User::find($employee['user_id']);
                                        $permission = json_decode($userpermissions,true);
                                        if($permission['success']=='true')
                                        {
                                            $userpermission = $permission['data'];
                                        }
                                        ?>
                                            <tr>
                                                <td>{{$userData->username}}</td>
                                                <td>{{$employee['name']}}</td>
                                                <td>{{$employee['email']}}</td>
                                                <td>{{$employee['phone']}}</td>
                                                <td>{{($employee['status']==1)?'Active':'In-Active'}}</td>
                                                <td>
                                                    <a href="/payroll/editconfig?id={{$employee['id']}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="javascript:void(0)" onclick="deleteEmployee({{$employee['id']}});"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>No Data Found</tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Listing Code End -->
    </div>
</div>



@include('layout.footer')