@extends('data-table.main')

@section('table')
    @can('create-position')
    <a class="btn btn-primary" href="javascript:void(0)" id="createPosition"> Add New Position</a>
    @endauth

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
                                <th>Division Name</th>
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

    <div class="modal fade" id="ajaxModelexa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="postForm" name="postForm" class="form-horizontal">
                       <input type="hidden" name="id" id="id">
                       <div class="form-group">
                        <label for="company" class="col-sm-6 control-label">Company</label>
                            <div class="col-sm-12">
                                <select class="form-select" name="company_id" id="company_id">
                                    <option selected disabled>Select Company</option>
                                        @foreach ($company as $c)
                                            <option value="{{ $c->id }}">{{ $c->company_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                         </div>

                        <div class="form-group">
                            <label for="position_name" class="col-sm-6 control-label">Position Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="position_name" name="position_name" placeholder="Enter Position Name" value="" required>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-primary" id="savedata" value="create">Save Position
                         </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(function () {

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "/positions",
          columns: [
              {data: 'no', name: 'no'},
              {data: 'company.company_name', name: 'company.company_name'},
              {data: 'position_name', name: 'position_name'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

        $('#createPosition').click(function () {
            $('#savedata').val("create-division");
            $('#id').val('');
            $('#postForm').trigger("reset");
            $('#modelHeading').html("Create New Position");
            $('#ajaxModelexa').modal('show');
        });

        $('body').on('click', '.editPosition', function () {
            var id = $(this).data('id');
            console.log(id);
            $.get("positions" +'/' + id , function (data) {
                $('#modelHeading').html("Edit Position");
                $('#savedata').val("edit-position");
                $('#ajaxModelexa').modal('show');
                $('#id').val(data.id);
                $('#company_id').val(data.company_id);
                $('#position_name').val(data.position_name);
            })
        });

        $('#savedata').click(function (e) {
            e.preventDefault();
            // $(this).html('Sending..');

            $.ajax({
            data: $('#postForm').serialize(),
            url: "/positions",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#postForm').trigger("reset");
                $('#ajaxModelexa').modal('hide');
                table.draw();
                Swal.fire({
                    icon: 'success',
                    title: 'Position saved successfully!',
                });
            },
            error: function (data) {
                console.log('Error:', data);
                $('#savedata').html('Save Changes');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
        });

        $('body').on('click', '.deletePosition', function () {
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
                        url: `/positions/${id}`,
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

