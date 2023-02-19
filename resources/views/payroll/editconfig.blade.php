@include('layout.header')
<script>
	function CalculateCTC()
{
    var basic_amount = 0;
    var da_amount = 0;
    var hra_amount = 0;
    var esic_amount = 0;
    var pf_amount = 0;
    var epf_amount = 0;
	var totalctc = $('#total_ctc').val();
	var basic = $('#basic_per').val();
	var da = $('#da_percent').val();
	var hra = $('#hra_percent').val();
	var esic = $('#esic_percent').val();
	var pf = $('#pf_percent').val();
	var epf = $('#epf_percent').val();
	var lta = $('#lta_percent').val();
	var ca = $('#ca_percent').val();
	var ma = $('#ma_percent').val();
	var gratuity = $('#gratuity_percent').val();
	var variance = $('#vr_percent').val();
   if(totalctc!='' && !isNaN(totalctc))
   {
     if(basic!='')
     {
        basic_amount = (totalctc * basic) / 100;
     }
     if(da!='')
     {
        da_amount = (basic_amount * da) / 100;
     }
     if(hra!='')
     {
        hra_amount = (basic_amount * hra) / 100;
     }
     if(pf!='')
     {
        pf_amount = (basic_amount * pf) / 100;
     }
     if(epf!='')
     {
        epf_amount = (basic_amount * epf) / 100;
     }
     if(esic!='')
     {
        esic_amount = (basic_amount * esic) / 100;
     }
     $('#basic_amount').val(basic_amount);
     $('#esic_amount').val(esic_amount);
     $('#lta_amount').val(lta);
     $('#epf_amount').val(epf_amount);
     $('#pf_amount').val(pf_amount);
     $('#hra_amount').val(hra_amount);
     $('#da_amount').val(da_amount);
     $('#ca_amount').val(ca);
     $('#ma_amount').val(ma);
     $('#gratuity_amount').val(gratuity);
     $('#variance_amount').val(variance);
	 var totalamount = parseInt(basic_amount) + parseInt(esic_amount) + parseInt(lta) + parseInt(epf_amount) + parseInt(pf_amount) + parseInt(hra_amount) + parseInt(da_amount) + parseInt(ca) + parseInt(ma) + parseInt(gratuity);
	 
	 var variablepay = parseInt(totalctc) - parseInt(totalamount);
	 $('#variance_amount').val(variablepay);
	 var amount = variablepay+totalamount;
	 $('#monthly_amount').val(amount);	
   }
   else
   {
    alert('Invalid Total CTC');
   }
}
</script>
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
                        <li class="breadcrumb-item active" aria-current="page">Edit Employee Configuration</li>
                    </ol>
                </nav>
            </div>
           
        </div>
        <!--end breadcrumb-->
        @include('layout.alert')
        <!-- Listing code start -->

        <div class="card radius-10">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                @csrf
				<input type="hidden" id="id" name="id" value="<?php echo $_GET['id'];?>">
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label for="" class="form-label">Total CTC</label>
                        <input type="text" required class="form-control" id="total_ctc" value="" placeholder="Total CTC" name="total_ctc">
                    </div>
                    <div class="col-12 col-lg-6">
                    </div>
                    <div class="card">
							<div class="card-body">
								<table class="table table-bordered mb-0">
									<thead>
										<tr>
											<th scope="col"></th>
											<th scope="col">Component</th>
											<th scope="col">Percentage/Fixed Amount</th>
											<th scope="col">Amount</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row"><input type="checkbox" name="basic_box" id="basic_box"></th>
											<td>Basic</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="basic_per" id="basic_per" class="form-control"><span>%</span></div></div></td>
											<td><input type="text" name="basic_amount" id="basic_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="da_box" id="da_box"></th>
											<td>Dearness Allowance (DA)</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="da_percent" id="da_percent" class="form-control"><span>%</span></div></div></td>
											<td><input type="text" name="da_amount" id="da_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="hra_box" id="hra_box"></th>
											<td>House Rent Allowance (HRA)</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="hra_percent" id="hra_percent" class="form-control"><span>%</span></div></div></td>
                                            <td><input type="text" name="hra_amount" id="hra_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="esic_box" id="esic_box"></th>
											<td>ESIC</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="esic_percent" id="esic_percent" class="form-control"><span>%</span></div></div></td>
                                            <td><input type="text" name="esic_amount" id="esic_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="pf_box" id="pf_box"></th>
											<td>PF Employee</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="pf_percent" id="pf_percent" class="form-control"><span>%</span></div></div></td>
                                            <td><input type="text" name="pf_amount" id="pf_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="epf_box" id="epf_box"></th>
											<td>PF Employeer</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="epf_percent" id="epf_percent" class="form-control"><span>%</span></div></div></td>
                                            <td><input type="text" name="epf_amount" id="epf_amount" class="form-control" readonly></td>
										</tr>
                                        <tr>
											<th scope="row"><input type="checkbox" name="ca_box" id="ca_box"></th>
											<td>Conveyance Allowance (CA)</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="ca_percent" id="ca_percent" class="form-control"></div></div></td>
                                            <td><input type="text" name="ca_amount" id="ca_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="ma_box" id="ma_box"></th>
											<td>Medical Allowance (MA)</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="ma_percent" id="ma_percent" class="form-control"></div></div></td>
                                            <td><input type="text" name="ma_amount" id="ma_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="lta_box" id="lta_box"></th>
											<td>LTA</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="lta_percent" id="lta_percent" class="form-control"></div></div></td>
                                            <td><input type="text" name="lta_amount" id="lta_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="gratuity_box" id="gratuity_box"></th>
											<td>Gratuity</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="gratuity_percent" id="gratuity_percent" class="form-control"></div></div></td>
                                            <td><input type="text" name="gratuity_amount" id="gratuity_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"><input type="checkbox" name="vr_box" id="vr_box"></th>
											<td>Variance</td>
											<td><div class="row"><div class="col-md-3" style="display: flex;"><input type="text" name="vr_percent" id="vr_percent" class="form-control"></div></div></td>
                                            <td><input type="text" name="variance_amount" id="variance_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row"></th>
											<td colspan="2">Total Per Month</td>
                                            <td><input type="text" name="monthly_amount" id="monthly_amount" class="form-control" readonly></td>
										</tr>
										<tr>
											<th scope="row" colspan="4" style="text-align:right;"><button class="btn btn-primary px-4" type="Button" onclick="CalculateCTC()">Calculate</button>
                                            </th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
                        <div class="col-12 col-lg-12">
                  <button class="btn btn-primary px-4" type="submit">Save
                  </button>
                </div>
                </div>
                </form>
            </div>
        </div>

        <!-- Listing Code End -->
    </div>
</div>




@include('layout.footer')
