@extends('data-table.main')

@section('table')
    @can('create-company')
    <a class="btn btn-primary" href="/create-companies"> Add New Company</a>
    @endauth

    @if(session('success'))
    <script>
        Swal.fire('Success', '{{ session('success') }}', 'success');
    </script>
    @endif

    <div class="row py-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- {{$dataTable->table()}} --}}
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Website</th>
                                <th>Address</th>
                                {{-- <th>Logo</th> --}}
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">
    $(function () {

        var SITEURL = '{{URL::to('')}}';

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "/companies",
          columns: [
              {data: 'no', name: 'no'},
              {data: 'company_name', name: 'company_name'},
              {data: 'email', name: 'email'},
              {data: 'phone_number', name: 'phone_number'},
              {data: 'website', name: 'website'},
              {data: 'address', name: 'address'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

        $('body').on('click', '.deleteCompany', function () {
            var id = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: `/companies/${id}`,
                        success: function (data) {
                            if(data.response){
                                Swal.fire('Deleted!', data.response, 'success');
                                $(`[data-id="${id}"]`).closest('tr').remove();
                            }else{
                                Swal.fire('Error!', data.error, 'error');
                            }
                        },
                        error: function (xhr) {
                            Swal.fire('Error!', data.response, 'error');
                        }
                    });
                }
            });
        });

    });
</script>
@endsection

