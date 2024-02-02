@extends('layout.main')

@section('container')
<div class="card">
    <div class="card-body">
        <form action="/employees/{{$employee->id}}" method="post" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
          <div class="mb-3">
              <label for="employee_name" class="form-label">Employee Name</label>
              <input type="text" class="form-control @error('employee_name') is-invalid @enderror" id="employee_name"
              name="employee_name" value="{{ old('employee_name', $employee->employee_name) }}"  required autofocus>
              @error('employee_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="employee_code" class="form-label">Employee Code</label>
            <input type="text" class="form-control @error('employee_code') is-invalid @enderror" id="employee_code"
            name="employee_code" value="{{ old('employee_code', $employee->employee_code) }}"  required autofocus>
            @error('employee_code')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <div class="input-group">
                <select class="form-select" name="company_id" id="company">
                    <option selected disabled>Select Company</option>
                        @foreach ($company as $c)
                        @if(old('company_id', $employee->company_id) == $c->id)
                            <option value="{{ $c->id }}" selected>{{ $c->company_name }}</option>
                        @else
                            <option value="{{ $c->id }}">{{ $c->company_name }}</option>
                        @endif
                        @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="division" class="form-label">Division</label>
            <div class="input-group">
                <select class="form-select" name="division_id" id="division">
                    <option value="{{$employee->division_id}}">{{$employee->division->division_name}}</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <div class="input-group">
                <select class="form-select" name="position_id" id="position">
                    <option value="{{$employee->position_id}}">{{$employee->position->position_name}}</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="name"
            name="email" value="{{ old('email', $employee->email) }}"  required autofocus>
            @error('email')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="name"
            name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}"  required autofocus>
            @error('phone_number')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="entry_date" class="form-label">Entry Date</label>
            <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="name"
            name="entry_date" value="{{ old('entry_date', $employee->entry_date) }}"  required autofocus>
            @error('entry_date')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="name"
            name="address" value="{{ old('address', $employee->address) }}"  required autofocus>
            @error('address')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="asset" class="form-label">Employee Image</label>
            <input type="hidden" name="oldImage" value="{{ $asset ? $asset->file_name : '' }}">

            @if ($asset && $asset->file_name)
                <img src="{{ url('/public/employee/' . $asset->file_name) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif

            <input class="form-control @error('asset') is-invalid @enderror" type="file" id="image" name="asset" onchange="previewImage()">

            @error('asset')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
          <button type="submit" class="btn btn-primary">Edit Employee</button>
        </form>
      </div>
</div>




  <script>

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
        }
    }
    </script>

<script>
    $(document).ready(function () {
        $('#company').change(function () {
            var company_id = $(this).val();

            // Make an AJAX request to get divisions and positions
            $.ajax({
                type: "GET",
                url: "/get-division-and-position",
                data: {company_id: company_id},
                dataType: "json",
                success: function (data) {
                    // Update the Division dropdown
                    var divisionDropdown = $('#division');
                    divisionDropdown.empty();
                    divisionDropdown.append('<option selected disabled>Select Division</option>');
                    $.each(data.divisions, function (id, division) {
                        divisionDropdown.append('<option value="' + division.id + '">' + division.division_name + '</option>');
                    });

                    // Update the Position dropdown
                    var positionDropdown = $('#position');
                    positionDropdown.empty();
                    positionDropdown.append('<option selected disabled>Select Position</option>');
                    $.each(data.positions, function (id, position) {
                        positionDropdown.append('<option value="' + position.id + '">' + position.position_name + '</option>');
                    });
                }
            });
        });
    });
</script>

@endsection
