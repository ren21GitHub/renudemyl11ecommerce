@extends('vendor.layouts.master')

@section('content')
    
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fas fa-images"></i> Product: {{$product->name}}</h3>
            <div class="card-header-action mb-3">
              <a href="{{route('vendor.products.index')}}" class="btn btn-warning"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            </div>
            <div class="section-body">
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                            <h4>Product: {{$product->name}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('vendor.products-image-gallery.store')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                                <div class="form-group wsus__input">
                                    <label for="">Image <code>(Multiple image supported!)</code></label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                    <input type="hidden" name="product" value="{{$product->id}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
  
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Products Image Gallery</h4>
                {{$dataTable->table()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->

@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

  <script>
    $(document).ready(function(){
      $('body').on('click', '.change-status', function(){

        let isChecked = $(this).is(':checked');
        let id = $(this).data('id');

        $.ajax({
          url: "{{route('vendor.products.change-status')}}",
          method: 'PUT',
          data: {
            _token: "{{ csrf_token() }}",
            status: isChecked,
            id: id
          },
          dataType: 'json',
          success: function(data){
            toastr.success(data.message);
          },
          error: function(xhr, status, error){
            console.log(error);
          }
        });

      });
    });
  </script>
@endpush