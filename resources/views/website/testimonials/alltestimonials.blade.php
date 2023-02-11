@include('layout.header')
<?php

use App\Models\testimonial;

$AllTestimonials = testimonial::getAllTestimonials();
$Testimonials = json_decode($AllTestimonials,true);
if($Testimonials['success']=='true')
{
    $testimonial = $Testimonials['data'];
}
?>
<div class="page-wrapper">
    <div class="page-content">
        @include('layout.alert')
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Manage Website</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Tesimonials</li>
                        <li class="breadcrumb-item active" aria-current="page">All Tesimonials</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                                <tr role="row">
                                    <th style="width:10%;">S. No.</th>
                                    <th style="width:60%">Title</th>
                                    <th style="width:15%">Date</th>
                                    <th style="width:15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($testimonial) && !empty($testimonial))
                                    {  $count =0;
                                        foreach($testimonial as $row)
                                    {   $count++;
                                        ?>
                                            <tr>
                                                <td><?php echo $count;?></td>
                                                <td><?php echo $row['title'];?></td>
                                                <td><?php echo date('d-m-Y',$row['date']);?></td>
                                                <td>
                                                <div class="d-flex order-actions justify-content-center">
                                                    <a href="/website/testimonial/add?id={{$row['id']}}" class=""><i class="bx bxs-edit"></i></a>
                                                    <a href="javascript:void(0);" onclick="deleteTestimonial({{$row['id']}})" class="ms-3"><i class="bx bxs-trash"></i></a>
                                                </div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr colspan="4">
                                                <td>No Data Found</td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



@include('layout.footer')