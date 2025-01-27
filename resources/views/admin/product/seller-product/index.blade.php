@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
    <section class="section">
      <div class="section-header">
        <h1>Seller's Product</h1>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>All Seller Products</h4>
                <div class="card-header-action">
                    <a href="{{route('admin.products.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                </div>
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

      // change approve status
      $('body').on('change', '.is_approve', function(){
        let value = $(this).val();
        let id = $(this).data('id');
        // console.log(value);

        $.ajax({
          url: "{{route('admin.changeApproveStatus')}}",
          method: 'PUT',
          data: {
            value: value,
            id: id,
          },
          dataType: 'json',
          success: function(data){
            toastr.success(data.message);
            window.location.reload();
          },
          error: function(xhr, status, error){
            console.log(error);
          }
        });
      });
    });
  </script>
@endpush