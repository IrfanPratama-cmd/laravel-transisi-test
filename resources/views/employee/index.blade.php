@extends('data-table.main')

@section('table')
    <div class="row">
        <div class="col-md-10">
            @can('create-employee')
            <a class="btn btn-primary" href="/create-employees"> Add New Employee</a>
            @endauth

            <a class="btn btn-danger" href="/employees-pdf"> PDF</a>
            <a class="btn btn-success" href="/employees-excel"> Excel</a>
        </div>
        <div class="col-md-2">
            <div class="btn-group">
                <button type="button" style="width: 200px" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter Company
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('employees') }}">All Employee</a>
                    @foreach($company as $c)
                        <a class="dropdown-item" href="{{ url('employees-by/' . $c->id) }}">{{ $c->company_name }}</a>
                    @endforeach
                </div>
              </div>
        </div>
    </div>




    @if(session('success'))
    <script>
        Swal.fire('Success', '{{ session('success') }}', 'success');
    </script>
    @endif

    <div class="row py-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee Name</th>
                                <th>Employee Code</th>
                                <th>Company Name</th>
                                <th>Division Name</th>
                                <th>Position Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Entry Date</th>
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
          ajax: "/employees",
          columns: [
              {data: 'no', name: 'no'},
              {data: 'employee_name', name: 'employee_name'},
              {data: 'employee_code', name: 'employee_code'},
              {data: 'company.company_name', name: 'company.company_name'},
              {data: 'division.division_name', name: 'division.division_name'},
              {data: 'position.position_name', name: 'position.position_name'},
              {data: 'email', name: 'email'},
              {data: 'phone_number', name: 'phone_number'},
              {data: 'entry_date', name: 'entry_date'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

        $('body').on('click', '.deleteEmployee', function () {
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
                        url: `/employees/${id}`,
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

