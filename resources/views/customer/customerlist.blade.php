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
<?php  return false; }

?>
<?php

use App\Http\Controllers\CustomerController;

$CustomerList = CustomerController::getCustomerList();
$customers = json_decode($CustomerList, true);
?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Costomers</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Customer List</li>
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
        <!-- Listing code start -->

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Customers</h6>
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
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Client Id</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Email ID</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Profile Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($customers['data']) && !empty($customers['data']))
                                {
                                    foreach($customers['data'] as $customer)
                                    {
                                        ?>
                                            <tr>
                                                <td>{{$customer['customerid']}}</td>
                                                <td>{{$customer['firstname'].' '. $customer['lastname']}}</td>
                                                <td>{{$customer['mobile']}}</td>
                                                <td>{{$customer['email']}}</td>
                                                <td>{{$customer['service']}}</td>
                                                <td>{{$customer['status']}}</td>
                                                <td><img src="{{$customer['profile_path']}}" class="product-img-2" alt="product img"></td>
                                                <td><i class="fa fa-pencil" aria-hidden="true"></i></td>
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