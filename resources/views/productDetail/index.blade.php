@include('layout.header')
<?php

use App\Http\Controllers\UserController;
use App\Models\designation;
use App\Models\productCategory;

$id = Session()->get('id');
$permission = UserController::getUserPermissionByName('product',$id);
$permissionarr = json_decode($permission, true);
if($permissionarr['success']=='false')
{?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>You Are Not Authorized Person For This Product</strong>
        </div>
    </div>
</div>
<?php  return false; }

?>

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
        <div class="btn-group">
          <a type="button" href='productDetail/create' class="btn btn-primary">Add New</a>
          
        </div>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($data) && !empty($data))
                                {
                                    foreach($data as $productDetail)
                                    {
                                    
                                        ?>
                                            <tr>
                                                <td>{{$productDetail['id']}}</td>
                                                <td>{{$productDetail['name']}}</td>
                                                <td>{{$productDetail['price']}}</td>
                                                <td><?php $cat = productCategory::getDataById($productDetail['category_id']); 
                                                echo $cat[0]->name;
                                                ?></td>
                                                <td>
                                                    <?php if($productDetail['status']==0){ echo '<span class="badge bg-danger">In-active</span>'; }
                                                    if($productDetail['status']==1){ echo '<span class="badge bg-success">Active</span>'; }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="productDetail/create?id={{$productDetail['id']}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="javascript:void(0)" onclick="deleteproductDetail({{$productDetail['id']}});"><i class="fa fa-trash" aria-hidden="true"></i></a>
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