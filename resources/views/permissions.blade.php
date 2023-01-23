@include('layout.header')
<?php

use App\Http\Controllers\UserController;
$id = Session()->get('id');
$permission = UserController::getUserPermissionByName('user',$id);
$permissionarr = json_decode($permission, true);
print_r($permissionarr);
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
<?php

$UserList = UserController::getAllUsers();
$Users = json_decode($UserList,true);

?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Permissions</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <!-- <a href="/AddUser"><button type="button" class="btn btn-primary">Add User</button></a> -->
                    <!-- <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                        <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div> -->
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        @include('layout.alert')
        <!-- Listing code start -->

        <div class="card radius-10">
            <div class="card-body">
                <!-- <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Users</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Given Modules</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($Users['data']) && !empty($Users['data']))
                                {
                                    foreach($Users['data'] as $user)
                                    {
                                        $userpermission = array();
                                        $userpermissions = UserController::getUserPermissions($user['id']);
                                        $permission = json_decode($userpermissions,true);
                                        if($permission['success']=='true')
                                        {
                                            $userpermission = $permission['data'];
                                        }
                                        ?>
                                            <tr>
                                                <td>{{$user['id']}}</td>
                                                <td>{{$user['name']}}</td>
                                                <td><?php foreach($userpermission as $up){echo ucfirst($up['permissionname']).', ';}?></td>
                                                <td><a href="javascript:void(0)" onclick="EditPermission(<?php echo $user['id']?>);"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
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
<div class="modal" tabindex="-1" id="permission_modal">
  <div class="modal-dialog">
    <form action="/UpdateUserPermission" method="post">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">User Permissions</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="permission_table">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </form>
  </div>
</div>


@include('layout.footer')