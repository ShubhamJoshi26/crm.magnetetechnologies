@include('layout.header')


<div class="page-wrapper">
    <div class="page-content">
        @include('layout.alert')
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Settings</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Ticket Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <label for="" class="label-control">Ticket Generation Numbers</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="bs-stepper-content">

                    <form id="ticketsetting" action="/setting/createticketsetting" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="prefix" class="form-label">Ticket Prefix</label>
                                <input type="text" required class="form-control" id="prefix" value="" placeholder="Ticket Prefix" name="prefix">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="saperator" class="form-label">Saperator</label>
                                <input type="text" required class="form-control" id="saperator" value="" placeholder="Saperator" name="saperator">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="lastnumber" class="form-label">Last Ticket Number</label>
                                <input type="text" required class="form-control" id="lastnumber" value="" placeholder="Last Ticket Number" name="lastnumber">
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 mt-3">
                            <button class="btn btn-primary px-4" type="submit">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>



@include('layout.footer')