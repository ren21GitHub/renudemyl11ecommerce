@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Image Gallery</h1>
        </div>
        <div class="card-header-action mb-3">
          <a href="{{route('admin.products.index')}}" class="btn btn-primary"> Back </a>
        </div>
        <div class="section-body">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h4>Product: {{$product->name}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.products-image-gallery.store')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group">
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

        <div class="section-body">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h4>All Products Image</h4>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
                
                </div>
            </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

  <script>
    $(document).ready(function(){
      $('body').on('click', '.change-status', function(){

        let isChecked = $(this).is(':checked');
        let id = $(this).data('id');

        $.ajax({
          url: "{{route('admin.products.change-status')}}",
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