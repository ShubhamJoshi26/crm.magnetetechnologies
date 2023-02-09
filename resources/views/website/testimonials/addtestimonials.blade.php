@include('layout.header')
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
                        <li class="breadcrumb-item active" aria-current="page">Add Tesimonials</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
      <div class="card-body">
            <form action="/website/testimonials/add" id="addtestimonials" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <input type='hidden' name='id' value=''/>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Testimonial Title</label>
                  <input type="text" required class="form-control" id="title" 
                  value="" placeholder="Testimonial Title" name="title">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Date</label>
                  <input type="text" required class="form-control datepicker" id="date" 
                  value="" placeholder="Testimonial Title" name="date">
                </div>
                <div class="col-12 col-lg-6">
                  <label for="" class="form-label">Image</label>
                  <input class="form-control" type="file" id="testifile" name="testifile">
                </div>
                <div class="col-12 col-lg-12">
                  <label for="" class="form-label">Description</label>
                  <textarea class="texteditor" name="description" id="description"></textarea>
                </div>
                </div>
                <div class="row">
                <div class="col-12 col-lg-2">
                <button class="btn btn-primary px-4" type="submit">Submit
                  </button>
                </div>
                </div>
            </form>

      </div>
        </div>

    </div>
</div>



@include('layout.footer')